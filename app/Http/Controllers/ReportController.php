<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        $accounts = Nasabah::all();

        return view('report.index', compact('accounts'));
    }

    public function print(Request $request)
    {
        $collection = Transaksi::query()
            ->where('account_id', $request->account_id)
            ->where('transaction_date', '>=', $request->start_transaction_date)
            ->where('transaction_date', '<=', $request->end_transaction_date)
            ->get();

        // dd($collection);

        $pdf = PDF::loadView('report.report-pdf', compact('collection'));

        return $pdf->download('report-pdf.pdf');
    }
}
