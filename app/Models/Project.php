<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class,'by_user_id');
    }

    protected $casts = [
        'setup' => 'array',
        'config' => 'array',
    ];

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when(
                $filters['name'] ?? false,
                fn ($query, $value) => $query->where('name', 'like', '%' . $value . '%')
            )
            ->when(
                $filters['orderBy'] ?? false,
                fn ($query, $value) => $query->orderBy('created_at', $value === 'latest' ? 'desc' : 'asc')
            )
            ->when(
                $filters['owner'] ?? false,
                fn ($query, $value) => $query->whereHas('owner', function ($q) use ($value) {
                    $q->where('name', 'like', '%' . $value . '%');
                })
            );
    }
}
