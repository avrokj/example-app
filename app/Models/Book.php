<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    public $timestamps = false; // kui ma ei soovi näha siis lisada
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'book_authors');
    }

    use HasFactory;
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'id'); // lõppu ei pea lisama id osa, kuna ta leiab tegelikult ise automaatselt
    }
}
