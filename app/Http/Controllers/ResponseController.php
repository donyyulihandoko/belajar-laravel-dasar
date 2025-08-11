<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response("Hello Response");
    }

    public function header()
    {
        $body = [
            'firstName' => 'Dony',
            'middleName' => 'Yuli',
            'lastName' => 'Handoko'
        ];

        return response(json_encode($body), 200)->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author' => 'Dony Yuli Handoko',
                'App' => 'Laravel'
            ]);
    }
}
