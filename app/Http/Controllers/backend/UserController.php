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
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),

        ]);

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
