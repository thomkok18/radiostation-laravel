<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Programma extends Model
{
    protected $fillable = ['programma_id', 'naam', 'starttijd', 'eindtijd', 'datum'];

    public function liedje()
    {
        return $this->belongsTo(Liedje::class);
    }

    public function getLiedjesById($id)
    {
        $count = DB::table('liedjes')->where('programma_id', $id)->count();
        return $count;
    }
}
