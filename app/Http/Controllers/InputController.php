<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $input = $request->input('name');
        return "Hello $input";
    }

    public function inputNested(Request $request)
    {
        $input = $request->input('name.first');
        return "Hello $input";
    }

    public function allInput(Request $request)
    {
        $input = $request->input();
        return json_encode($input);
    }

    public function inputArray(Request $request)
    {
        $input = $request->input('product.*.name');
        return json_encode($input);
    }
}
