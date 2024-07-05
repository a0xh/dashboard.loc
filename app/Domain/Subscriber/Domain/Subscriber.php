<?php

namespace App\Domain\Subscriber\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Application\Enums\StatusEnum;

class Subscriber extends Model
{
    use HasUuids;

    protected $table = 'subscribers';
    protected $keyType = 'uuid';
    
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
        'email',
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
            'email' => 'string',
            'status' => StatusEnum::class,
            'data' => 'array',
        ];
    }

    public static function booted(): void
    {
        static::creating(function (Subscriber $subscriber) {
            $subscriber->id = Str::uuid()->toString();
        });
    }
    
    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($data) => json_decode($data),
            set: fn ($data) => json_encode($data),
        );
    }
}
