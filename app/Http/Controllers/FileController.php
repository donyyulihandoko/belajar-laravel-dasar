<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadFile(Request $request): string
    {
        $image = $request->file('image');
        $image->storePubliclyAs('pictures', $image->getClientOriginalName(), "public");

        return "OK " . $image->getClientOriginalName();
    }
}
