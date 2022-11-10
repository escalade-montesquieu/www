<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function getPanel(Request $request)
    {
        $users = User::where('level', '1')->get();
        $modos = User::where('level', '2')->get();
        $admins = User::where('level', '3')->get();
        return view('admin.panel', compact('users', 'modos', 'admins'));
    }

    public function getUsers(Request $request)
    {
        $users = User::where('level', '1')->get();
        $modos = User::where('level', '2')->get();
        $admins = User::where('level', '3')->get();
        return view('admin.users', compact('users', 'modos', 'admins'));
    }

    public function modifyUser(Request $request, $uuid)
    {
        if(!$user = User::where('uuid', $uuid)->first()) {
            return response('not found')->status(404);
        }
        $user->level = request('level', $user->level);
        $user->save();
        return response()->json($user);
    }

    public function destroyUser(Request $request, $uuid)
    {
        if(!$user = User::where('uuid', $uuid)->first()) {
            return response('not found')->status(404);
        }
        $user->delete();
        return response('ok')->status(200);

    }




    public function getMembers(Request $request)
    {
        $members = Student::select('name', 'class')->get();
        return view('admin.members', compact('members'));
    }

    public function addMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:members,name',
            'classroom' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages());
        }
        if(Student::where('name', request('name'))->count() > 0) {
            return response('already exist')->status(400);
        } else {
            Student::create([
                'name' => request('name'),
                'class' => request('classroom'),
            ]);
            return response('ok')->status(200);
        }
    }

    public function destroyMember(Request $request, $name)
    {
        if(!$member = Student::where('name', $name)->first()) {
            return response('not found')->status(404);
        }
        if($member->name !== Auth::User()->name) {
            $member->delete();
            return response('ok')->status(200);
        }

        return response('it is you')->status(400);
    }




    public function getInfos(Request $request)
    {
        $infos = Info::all();
        $archivedInfos = Info::onlyTrashed()->get();
        return view('admin.infos', compact('infos', 'archivedInfos'));
    }

    public function addInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:info,title',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages());
        }
        $info = Info::create([
            'title' => request('title'),
            'content' => request('content'),
        ]);
        return response()->json('ok', 200);

    }

    public function modifyInfo(Request $request, $id)
    {
        if(!$info = Info::where('id', $id)->first()) {
            return response()->json('not found', 404);
        }
        $info->title = request('title');
        $info->content = request('content');
        $info->save();
        return response()->json('ok',200);
    }

    public function destroyInfo(Request $request, $id)
    {
        if(!$info = Info::where('id', $id)->first()) {
            return response()->json('not found', 404);
        }
        $info->delete();
        return response()->json('ok',200);
    }

    public function publishInfo(Request $request, $id)
    {
        if(!$info = Info::onlyTrashed()->where('id', $id)->first()) {
            return response()->json('not found', 404);
        }
        $info->restore();
        return response()->json('ok',200);
    }

}

