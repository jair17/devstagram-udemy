<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;

class ImageController extends Controller
{
    public function store (Request $request){
        $image = $request->file('file');

        $imageName = Str::uuid() . "." . $image->extension();

        $manager = new ImageManager(Driver::class);

        $imageManage = $manager->read($image);
        $imageManage->resize(1000, 1000);
        $imagePng = $imageManage->toPng();
        $imagePath = public_path('uploads/' . $imageName);
        $imagePng->save($imagePath);

        return response()->json(['image' => $imageName]);
    }
}
