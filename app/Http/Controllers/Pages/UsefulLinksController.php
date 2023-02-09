<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsefulLinksController extends Controller
{
    public function index()
    {
        $links = \App\Models\UsefulLink::all();
        return view('useful-links', compact('links'));
        // return view('useful-links');
        // return view('pages.useful-links.index');
    }
}
