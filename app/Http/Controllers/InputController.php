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

    public function inputType(Request $request)
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthday = $request->date('birthday', 'Y-m-d',);

        return json_encode([
            'name' => $name,
            'married' => $married,
            'birthday' => $birthday->format('Y-m-d')
        ]);
    }

    public function inputOnly(Request $request)
    {
        $name = $request->only('name.first', 'name.middle');
        return json_encode($name);
    }

    public function inputExcept(Request $request)
    {
        $user = $request->except('admin');
        return json_encode($user);
    }

    // input merge
    public function inputMerge(Request $request)
    {
        $request->merge([
            'admin' => 'false'
        ]);
        $user = $request->input();
        return json_encode($user);
    }
}
