<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;

class PoinController extends Controller
{
    public function index()
    {
        $collection = Nasabah::query()->with('nasabah_poins')->get();

        return view('poin.index', compact('collection'));
    }
}
