<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(request()->query('user'));
        return view('blogs.profiles.index', compact('user'));
    }


    public function edit(User $user)
    {
        $user->authorize($user->id);
        return view('blogs.profiles.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->authorize($user->id);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,gif,png', 'max:1024'],
        ]);
        if ($request->hasFile('image')) {
            $request->file('image');
            if (Storage::exists($user->image)) {
                Storage::delete($user->image);
            }
            $data['image'] = $request->file('image')->store('profiles');
        }
        $user->update($data);
        return redirect(route('profile', ['user' => $user->id]))->with('success', 'Updated successfull');
    }
}
