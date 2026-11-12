<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    public const PENDING = 'pending';
    public const PROCESSING = 'diproses';
    public const DONE = 'selesai';
    public const CANCELLED = 'dibatalkan';

    /**
     * Aturan perpindahan status yang diizinkan.
     */
    public const TRANSITIONS = [
        self::PENDING => [self::PROCESSING, self::CANCELLED],
        self::PROCESSING => [self::DONE, self::CANCELLED],
        self::DONE => [],
        self::CANCELLED => [],
    ];

    protected $fillable = [
        'user_id',
        'status',
        'total',
        'recipient_name',
        'phone',
        'address',
        'note',
    ];

    protected $casts = [
        'total' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Kembalikan stok produk saat pesanan dibatalkan.
     */
    public function restoreStock(): void
    {
        foreach ($this->items as $item) {
            if ($item->product_id) {
                Product::whereKey($item->product_id)->increment('stock', $item->quantity);
            }
        }
    }

    public function allowedNextStatuses(): array
    {
        return self::TRANSITIONS[$this->status] ?? [];
    }

    public function canTransitionTo(string $status): bool
    {
        return in_array($status, $this->allowedNextStatuses(), true);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::PENDING => '#b26a00',
            self::PROCESSING => '#1565c0',
            self::DONE => '#1b5e20',
            self::CANCELLED => '#b3261e',
            default => '#555',
        };
    }
}
