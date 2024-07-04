<?php

namespace App\Domain\Role\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Role extends Model
{
    protected $table = 'roles';
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
    protected $fillable = ['name', 'slug', 'data'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
            'slug' => 'string',
            'data' => 'array',
        ];
    }

    public static function booted(): void
    {
        static::creating(function (Role $role) {
            $role->id = Str::uuid();
        });
    }
    
    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($data) => json_decode($data),
            set: fn ($data) => json_encode($data),
        );
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(\App\Domain\User\Domain\User::class);
    }
}
