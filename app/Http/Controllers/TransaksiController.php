<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Poin;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    public function index()
    {
        $nasabahCollection = Nasabah::all();

        if (count($nasabahCollection) == 0) {
            Session::flash('message', 'Data nasabah kosong');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('nasabah.index');
        }

        $collection = Transaksi::all();

        return view('transaksi.index', compact('nasabahCollection', 'collection'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $data = new Transaksi();
            $data->account_id = $request->account_id;
            $data->transaction_date = date('Y-m-d', strtotime($request->transaction_date));
            $data->description = $request->description;
            $data->debit_credit_status = $request->debit_credit_status;
            $data->amount = $request->amount;

            $data->save();

            $counter = 0;

            switch ($request->description) {
                case 'Beli Pulsa':
                    $poin = new Poin();
                    $poin->account_id = $request->account_id;
                    $poin->transaction_id = $data->id;
                    if ($request->amount >= 0 && $request->amount <= 10000) {
                        $nilaiPoin = 0;
                    } elseif ($request->amount > 10001 && $request->amount <= 30000) {
                        for ($i = 1000; $i <= $request->amount; $i++) {
                            if ($i % 1000 == 0) {
                                $counter++;
                            }
                        }

                        $nilaiPoin = 1 * $counter;
                    } elseif ($request->amount > 30000) {
                        for ($i = 1000; $i <= $request->amount; $i++) {
                            if ($i % 1000 == 0) {
                                $counter++;
                            }
                        }

                        $nilaiPoin = 2 * $counter;
                    }
                    $poin->poin = $nilaiPoin;
                    $poin->save();
                    break;

                case 'Bayar Listrik':
                    $poin = new Poin();
                    $poin->account_id = $request->account_id;
                    $poin->transaction_id = $data->id;
                    if ($request->amount >= 0 && $request->amount <= 50000) {
                        $nilaiPoin = 0;
                    } elseif ($request->amount > 50000 && $request->amount <= 100000) {
                        for ($i = 2000; $i <= $request->amount; $i++) {
                            if ($i % 2000 == 0) {
                                $counter++;
                            }
                        }

                        $nilaiPoin = 1 * $counter;
                    } elseif ($request->amount > 100000) {
                        for ($i = 2000; $i <= $request->amount; $i++) {
                            if ($i % 2000 == 0) {
                                $counter++;
                            }
                        }

                        $nilaiPoin = 2 * $counter;
                    }
                    $poin->poin = $nilaiPoin;
                    $poin->save();
                    break;
                default:
                    # code...
                    break;
            }

            DB::commit();

            Session::flash('message', 'Successfully');
            Session::flash('alert-class', 'alert-success');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            Session::flash('message', $th->getMessage());
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect()->route('transaksi.index');
    }
}
