<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $fillable = ['nama', 'deskripsi', 'gambar', 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }
}
