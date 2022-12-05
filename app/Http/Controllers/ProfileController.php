<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show(Request $request, User $user = null)
    {
        if (!$user) {
            $user = Auth::user();
        }

        return view('profile.show', [
            'user' => $user
        ]);
    }

    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|string',
            'name' => 'nullable|string|max:255|unique:users,name,' . Auth::user()->id,
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
        $user->max_voie = request('max_voie', $default = 'Non renseigné');
        $user->max_bloc = request('max_bloc', $default = 'Non renseigné');
        if ($request->has('display_max')) {
            $user->display_max = 0;
        } else {
            $user->display_max = 1;
        }
        if ($request->has('harness')) {
            $user->harness = 1;
        } else {
            $user->harness = 0;
        }

        if ($request->has('email_preferences')) {
            $user->email_preferences = implode('', array_keys(request('email_preferences')));
        } else {
            $user->email_preferences = '';
        }

        $user->shoes = request('shoes', $default = 'no-need');
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->save();

        return redirect('/profile')->with('status', 'success')->with('content', 'Modifications enregistrées');
    }
}

