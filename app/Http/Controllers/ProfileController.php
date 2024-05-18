<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->input('username'))]);
        $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:20', 'unique:users,username,' . auth()->user()->id, 'not_in:twitter,editar-perfil']
        ]);

        if ($request->file) {
            $image = $request->file('file');

            $imageName = Str::uuid() . "." . $image->extension();

            $manager = new ImageManager(Driver::class);

            $imageManage = $manager->read($image);
            $imageManage->resize(1000, 1000);
            $imagePng = $imageManage->toPng();
            $imagePath = public_path('profiles/' . $imageName);
            $imagePng->save($imagePath);
        }
        $user = User::find(auth()->user()->id);
        $user->username = $request->input('username');
        $user->image = $imageName ?? auth()->user()->image ?? null;
        $user->save();

        return redirect()->route('posts.index',$user);
    }
}
