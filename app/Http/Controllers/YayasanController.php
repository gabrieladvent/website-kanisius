<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YayasanController extends Controller
{
    public function kiriman() {
        return view('tablesekolah');
    }
}
