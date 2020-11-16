<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;

class UploadController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 10);
    }

    public function upload(UploadRequest $request)
    {
        $uploadedFile = $request->file('file');

        return back();
    }
}
