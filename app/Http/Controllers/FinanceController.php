<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $reports = session('finance_reports', []);
        return view('admin.dashboard', compact('reports'));
    }

    public function store(Request $request)
    {
        $reports = session('finance_reports', []);

        $reports[] = [
            'date' => $request->date,
            'type' => $request->type,
            'note' => $request->note,
            'amount' => $request->amount,
        ];

        session(['finance_reports' => $reports]);

        return redirect()->back();
    }
}
