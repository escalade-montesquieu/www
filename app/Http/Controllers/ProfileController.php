<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }


    public function show(Request $request, $user_uuid)
    {
        if($user = User::where('uuid', $user_uuid)->first()) {
            return view('profile.show', compact('user'));
        }

        if($user = User::where('name', ucwords(strtolower($user_uuid)))->first()) {
            return view('profile.show', compact('user'));
        }

        abort(404);
    }

    public function bySession(Request $request) {
        if (!$user = Auth::user()) {
            // $user = Auth::user();
            return response()->json('Forbidden', 400);
        }

        $session = $request;
        return response()->json(compact('user', 'session'));
    }

    public function img(Request $request, $user_uuid)
    {
        if(!$user = User::firstWhere('uuid', $user_uuid)) {
            return response()->file(public_path().'/assets/profiles/user.png');
        }

        if($user->img === "/assets/profiles/user.png") {
            return redirect('https://eu.ui-avatars.com/api/?size=256&name='.$user->name.'&background=e5e5e5&color=8c8b87&rounded=true&bold=true');
            // return response()->file(public_path().'/assets/profiles/user.png');
        }

        return response()->file(public_path().$user->img);
    }


    public function edit(Request $request)
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function changeImg(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json('fail', 400);
        }

        $user = Auth::user();

        try {
            if($user->img !=="/assets/profiles/user.png") {
                File::delete(public_path().$user->img);
            }
        } catch(Exception $e) {
            // nothing
        }

        $imageName = $user->uuid.'.'.request('img')->getClientOriginalExtension();
        request('img')->move(public_path('assets/profiles/'), $imageName);

        $user->img = '/assets/profiles/'.$imageName;
        $user->save();

        return response()->json('done');
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|string',
            'name' => 'nullable|string|max:255|unique:users,name,'.Auth::user()->id,
            'bio' => 'nullable|string',
            'max_voie' => 'nullable|string',
            'max_bloc' => 'nullable|string',
            'shoes' => 'string'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $user = Auth::user();

        // $user->name = ucwords(strtolower(request('name')));
        $user->email = request('email');
        $user->bio = request('bio');
        $user->max_voie = request('max_voie', $default='Non renseigné');
        $user->max_bloc = request('max_bloc', $default='Non renseigné');
        if($request->has('display_max')){
            $user->display_max = 0;
        } else {
            $user->display_max = 1;
        }
        if($request->has('harness')){
            $user->harness = 1;
        } else {
            $user->harness = 0;
        }

        if($request->has('email_preferences')) {
            $user->email_preferences = implode('', array_keys(request('email_preferences')));
        } else {
            $user->email_preferences = '';
        }

        $user->shoes = request('shoes', $default='no-need');
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->save();

        return redirect('/profil')->with('status', 'success')->with('content', 'Modifications enregistrées');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        return view('profile.changePassword', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'new_password' => 'required|string',
            'new_password_confirmation' => 'required|same:new_password'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        if (request('password') !== null) {
            if (Hash::check(request('password'), $user->password)) {
                $user->password =  Hash::make(request('new_password'));
                $user->save();
            } else {
                $error = ['password' => 'Le mot de passe est incorrect'];
                return back()->withInput()->withErrors($error);
            }
        }


        return redirect('/profil')->with('status', 'success')->with('content', 'Modifications enregistrées');
    }

}

