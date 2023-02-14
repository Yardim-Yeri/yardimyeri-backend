<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class UsefulLinksController extends Controller
{
    public function index()
    {
        $links = \App\Models\UsefulLink::all();
        
        return response()->json(['success' => true, 'message' => null, 'result' => $links]);
    }
}
