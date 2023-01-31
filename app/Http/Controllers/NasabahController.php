<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NasabahController extends Controller
{
    public function index()
    {
        $collection = Nasabah::all();

        return view('nasabah.index', compact('collection'));
    }

    public function store(Request $request)
    {
        try {
            $data = new Nasabah();
            $data->account_id = random_int(1, 100) + 1;
            $data->name = $request->name;
            $data->save();

            Session::flash('message', 'Successfully');
            Session::flash('alert-class', 'alert-success');
        } catch (\Throwable $th) {
            Session::flash('message', $th->getMessage());
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect()->route('nasabah.index');
    }
}
