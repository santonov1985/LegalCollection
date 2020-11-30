<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivateBailiffController extends Controller
{
    public function index() {
        return view('tables.privateBailiff.index');
    }
}
