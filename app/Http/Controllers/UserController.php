<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('roles');
        if ($request->name != "") {
            $users->where("first_name", "LIKE", "%" . $request->name . "%");
        }
        $users = $users->get();

        return view("users.index", compact('users'));
    }

    public function create()
    {
        return view("users.create");
    }

    public  function store(Request $request)
    {
        $attributes = request()->validate([
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
        $attributes['role_slug'] = "teacher";
        $user = User::create($attributes);
        return redirect(route("users.index"));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view("users.edit", compact('user'));
    }

    public  function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route("users.index"))->withErrors("Có lỗi xảy ra");
        }
        if ($request->password != "") {
            $user = User::find($id)->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'password' => $request->password,
            ]);
        } else {
            $user = User::find($id)->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
            ]);
        }

        return redirect(route("users.index"));
    }

    public function delete($id)
    {
        $user = User::where('id',$id)->delete();

        return redirect(route("users.index"));
    }
}
