<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liedje extends Model
{
    protected $fillable = ['programma_id', 'user_id', 'artiestnaam', 'liedjenaam', 'lengte'];

    public function programma()
    {
        return $this->belongsTo(Programma::class);
    }
}
