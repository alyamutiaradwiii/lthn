<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = "bukus";
    protected $primaryKey = "id";
    protected $fillable = [
        'id','judul','penulis','penerbit','tahunTerbit'
    ];

    public function relasi() 
    {
        return $this->hasMany(Koleksi_relasi::class);
    }
    public function ulasan() 
    {
        return $this->hasMany(Ulasan_buku::class);
    }
    public function koleksi() 
    {
        return $this->hasMany(Koleksi_pribadi::class);
    }
    public function peminjaman() 
    {
        return $this->hasMany(Peminjaman::class);
    }
}
