<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientCheckController extends Controller
{
    Public function index()
    {
        return view('client.pages.checkout.index');
    }
}
