<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Client extends Model
{
    use HasFactory;

    public function orders(): HasMany
    {
        return $this->HasMany(Order::class);
    }

    public function books(): HasManyThrough // et siis läbi mitme. https://laravel.com/docs/10.x/eloquent-relationships#has-many-through
    {
        return $this->hasManyThrough(Book::class, Order::class, secondKey: 'id', secondLocalKey: 'book_id');
    }
}
