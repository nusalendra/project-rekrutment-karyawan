<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function beranda()
    {
        return view('pages.guest.beranda', ['title' => 'Beranda']);
    }

    public function berandaPelamar()
    {
        return view('pages.pelamar.beranda.index', ['title' => 'Beranda']);
    }
}
