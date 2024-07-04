<?php

namespace App\Domain\Order\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Application\Enums\StatusEnum;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $table = 'orders';
    protected $keyType = 'string';

    public $incrementing = false;
    
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'status',
        'data'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'product_id' => 'string',
            'user_id' => 'string',
            'quantity' => 'int',
            'status' => StatusEnum::class,
            'data' => 'array',
        ];
    }

    public static function booted(): void
    {
        static::creating(function (Order $order) {
            $order->id = Str::uuid();
        });
    }
    
    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($data) => json_decode($data),
            set: fn ($data) => json_encode($data),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\User\Domain\User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Product\Domain\Product::class);
    }
}
