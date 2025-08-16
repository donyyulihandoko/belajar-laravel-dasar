<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    public function responseView(Request $request): Response
    {
        return response()
            ->view('hello', [
                'name' => 'dony'
            ]);
    }

    public function responseJson(): JsonResponse
    {
        $body = [
            'firstName' => 'Dony',
            'middleName' => 'Yuli',
            'lastName' => 'Handoko'
        ];
        return response()
            ->json($body);
    }

    public function responseFile(): BinaryFileResponse
    {
        return response()
            ->file(\storage_path('app/public/pictures/activity.png'));
    }

    public function responseDonwload(): BinaryFileResponse
    {
        return response()
            ->download(\storage_path('app/public/pictures/activity.png'));
    }
}
