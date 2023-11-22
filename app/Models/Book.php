<?php

namespace App\Models;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

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

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (float $value) => number_format(round($value, 2), 2, ','),
            set: fn (string $value) => str_replace(',', '.', $value),
        );
    }
}
