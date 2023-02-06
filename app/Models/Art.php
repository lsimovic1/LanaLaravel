<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'value',
        'artist_id',
        'form_id'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
