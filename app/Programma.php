<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programma extends Model
{
    protected $fillable = ['programma_id', 'naam', 'starttijd', 'eindtijd', 'datum'];

    public function liedje()
    {
        return $this->belongsTo(Liedje::class);
    }
}
