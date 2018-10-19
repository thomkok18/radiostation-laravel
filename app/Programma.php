<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Programma extends Model
{
    protected $fillable = ['user_id', 'naam', 'starttijd', 'eindtijd', 'datum'];

    public function liedje()
    {
        return $this->hasMany(Liedje::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getLiedjesById($id)
    {
        $count = DB::table('liedjes')->where('programma_id', $id)->count();
        return $count;
    }
}
