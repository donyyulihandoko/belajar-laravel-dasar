<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormController extends Controller
{
    public function form(): Response
    {
        return response()->view('Form.index');
    }

    public function postForm(Request $request): Response
    {
        $name = $request->input('name');

        return response()->view('hello', [
            'name' => $name
        ]);
    }
}
