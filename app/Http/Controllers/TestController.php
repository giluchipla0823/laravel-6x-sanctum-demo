<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
        $data = [
            'id' => 1,
            'name' => 'Gino Luiggi'
        ];

        return response()->json($data);
    }
}
