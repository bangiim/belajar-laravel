<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama'];

    public function berita()
    {
        return $this->hasMany('App\Berita');
    }
}
