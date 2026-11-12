<?php

namespace App\Http\Controllers;

use App\Models\FinanceReport;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'nullable|in:' . FinanceReport::INCOME . ',' . FinanceReport::EXPENSE,
        ]);

        // Ringkasan dihitung dari rentang tanggal saja (tidak terpengaruh filter jenis)
        $base = FinanceReport::dateRange($request->start_date, $request->end_date);

        $totalIncome = (clone $base)->where('type', FinanceReport::INCOME)->sum('amount');
        $totalExpense = (clone $base)->where('type', FinanceReport::EXPENSE)->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $reports = (clone $base)
            ->when($request->type, fn ($q, $type) => $q->where('type', $type))
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->get();

        return view('admin.dashboard', compact('reports', 'totalIncome', 'totalExpense', 'balance'));
    }

    public function store(Request $request)
    {
        FinanceReport::create($this->validated($request));

        return redirect()->route('admin.dashboard')
            ->with('success', 'Laporan keuangan berhasil ditambahkan.');
    }

    public function edit(FinanceReport $report)
    {
        return view('admin.finance.edit', compact('report'));
    }

    public function update(Request $request, FinanceReport $report)
    {
        $report->update($this->validated($request));

        return redirect()->route('admin.dashboard')
            ->with('success', 'Laporan keuangan berhasil diperbarui.');
    }

    public function destroy(FinanceReport $report)
    {
        $report->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Laporan keuangan berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:' . FinanceReport::INCOME . ',' . FinanceReport::EXPENSE,
            'amount' => 'required|integer|min:1|max:1000000000000',
            'note' => 'nullable|string|max:255',
        ]);
    }
}
