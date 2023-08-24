<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    // 寫入圖片
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        $folder = 'images';

        $file = $request->file('file');
        $file->storeAs($folder, $file->getClientOriginalName(), 'gcs');

        $pathToFile = $folder . '/' . $file->getClientOriginalName();
        $gcsPath = Storage::disk('gcs')->url($pathToFile);

        return [
            'pathToFile' => $pathToFile,
            'gcsPath' => $gcsPath,
        ];
    }
}
