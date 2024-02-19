<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koleksi_pribadi extends Model
{
    protected $table = "koleksi_pribadis";
    protected $primaryKey = "id";
    protected $fillable = [
        'id','user_id', 'buku_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
