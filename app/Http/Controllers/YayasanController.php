<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YayasanController extends Controller
{
    public function kiriman($title) {
        return view('tablesekolah', compact('title'));
    }
}
