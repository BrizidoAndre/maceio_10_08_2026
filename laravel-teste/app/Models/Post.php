<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts()
    {
        return [
            'public' => 'boolean',
        ];
    }

    #[Scope]
    protected function ownPost(Builder $query): Builder
    {
        return $query->where('user_id', auth()->id());
    }
}
