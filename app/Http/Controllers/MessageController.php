<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\LatestMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;

// use App\Mail\MentionnedInMessage;
use App\Jehona\MentionnedInMessageJehona;

use GuzzleHttp;
use Carbon;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'forum' => 'required|string|max:255',
            'author' => 'required|string',
            'author_uuid' => 'required|string',
            'content' => 'required|string',
            'push_key' => 'required|string'
        ]);

        if ($validator->fails() || request('push_key')!==config('services.pusher.key')) {
            return abort(400);
        }

        date_default_timezone_set('Europe/Paris');

        $time = now();

        $message = Message::create([
            'forum' => request('forum'),
            'author' => request('author'),
            'author_uuid' => request('author_uuid'),
            'content' => request('content')
        ]);

        if(!$latest_message = LatestMessage::where('forum', request('forum'))->first()) {
            $latest_message = LatestMessage::create([
                'id' => $message->id,
                'forum' => request('forum'),
                'created_at' => $time
            ]);
        } else {
            $latest_message->id = $message->id;
            $latest_message->created_at = $time;
            $latest_message->save();
        }

        $client = new GuzzleHttp\Client();

        // $body = [
        //     'multipart' => [
        //         [
        //             'name'     => 'key',
        //             'contents' => config('services.pusher.key')
        //         ],
        //         [
        //             'name'     => 'forum',
        //             'contents' => $message->forum
        //         ],
        //         [
        //             'name'     => 'id',
        //             'contents' => $message->id
        //         ],
        //         [
        //             'name'     => 'author',
        //             'contents' => $message->author
        //         ],
        //         [
        //             'name'     => 'author_uuid',
        //             'contents' => $message->author_uuid
        //         ],
        //         [
        //             'name'     => 'content',
        //             'contents' => $message->content
        //         ],
        //         [
        //             'name'     => 'created_at',
        //             'contents' => $time
        //         ],
        //     ]
        // ];
        // $res = $client->request('POST', 'localhost:8001/post', $body);
        // $res = $client->request('POST', config('services.pusher.domain'), $body);

        preg_match_all("/@(\S|_)+/", $message->content, $mentions, PREG_SET_ORDER);
        $message->content = $mentions;
        foreach ($mentions as $mention) {
            $mention = str_replace(['@','_'], ['',' '], $mention[0]);
            $message->content = $mention;
            if($mention==="everyone") {
                $bcclist = User::pluck('email');

                $mentionnedJehona = new MentionnedInMessageJehona($message, [
                    'recipients' => $bcclist->toArray(),
                    'toAll' => true
                ]);
                $mentionnedJehona->dispatch();
                // $bccnamelist = User::pluck('name');
                // Mail::bcc($bcclist, $bccnamelist)
                //         ->send(new MentionnedInMessage($message, true));
                // break;
            } else if($user = User::where('name', $mention)->first()) {
                // Mail::to($user->email, $user->name)->send(new MentionnedInMessage($message, false));
                $mentionnedJehona = new MentionnedInMessageJehona($message, [
                    'recipients' => [$user->email],
                    'toAll' => false
                ]);
                $mentionnedJehona->dispatch();
            }

        }
        // return response()->json(compact('message'));
        return response()->json('ok',200);
    }

    public function latests(Request $request) {
        $latests = LatestMessage::all();

        return response()->json(compact('latests'));
    }
}
