<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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
}
