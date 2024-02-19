<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koleksi_relasi extends Model
{
    protected $table = "koleksi_relasis";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'buku_id', 'kategori_id'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }

}
