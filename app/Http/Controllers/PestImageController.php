<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Pest;
use App\Models\PestImage;

class PestImageController extends Controller
{
    public function store(Request $request, Pest $pest)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $path = $request->file('image')->store('public/pests/' . $pest->id . '/images');
        $size = $request->file('image')->getSize();
        $caption = $request->input('caption');

        $image = new PestImage();
        $image->path = $path;
        $image->size = $size;
        $image->caption = $caption;
        $image->pest_id = $pest->id;
        $image->save();

        return $this->success($image);
    }
}
