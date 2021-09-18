<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $all_users= User::latest()->get();
       return response()->json($all_users, 200);
    }


    public function edit(User $user)
    {
       return response()->json($user, 200);
    }


    public function update(Request $request, User $user)
    {
        $read = "";
        $write = "";
        $edit = "";
        $destroy = "";

        if ($request->read == "true"){
            $read = "true";
        } else {
            $read = "";
        }

        if ($request->write == "true"){
            $write = "true";
        } else {
            $write = "";
        }

        if ($request->edit == "true"){
            $edit = "true";
        } else {
            $edit = "";
        }

        if ($request->destroy == "true"){
            $destroy = "true";
        } else {
            $destroy = "";
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'read' => $read,
            'write' => $write,
            'edit' => $edit,
            'destroy' => $destroy,
        ]);

        // $user->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'role' => $request->role,
        //     'read' => $request->read,
        //     'write' => $request->write,
        //     'edit' => $request->edit,
        //     'destroy' => $request->destroy,
        // ]);

        return response()->json($user, 200);
    }


    public function User_Password_Update(Request $request)
    {
        $email = $request->email;

        $user_data = User::where('email', $email)->get();

        $id = $user_data[0]->id;

       $user =  User::findOrFail($id);

       $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 200);
    }


    public function destroy(User $user)
    {
        if ($user) {
            $userImage = $user->image;
            $imagePath = public_path($userImage);

            if ($userImage && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $user->delete();
        } else {
            return response()->json('User not found.', 404);
        }
    }

}
