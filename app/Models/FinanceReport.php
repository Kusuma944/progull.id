<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FinanceReport extends Model
{
    public const INCOME = 'Pemasukan';
    public const EXPENSE = 'Pengeluaran';

    protected $fillable = [
        'date',
        'type',
        'amount',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'integer',
    ];

    /**
     * Filter berdasarkan rentang tanggal (keduanya opsional).
     */
    public function scopeDateRange(Builder $query, ?string $start, ?string $end): Builder
    {
        return $query
            ->when($start, fn ($q) => $q->whereDate('date', '>=', $start))
            ->when($end, fn ($q) => $q->whereDate('date', '<=', $end));
    }
}
