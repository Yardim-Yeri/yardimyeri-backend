<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $table = 'sokak_cadde';
    protected $primaryKey = 'sokak_cadde_id';
    protected $fillable = ['sokak_cadde_title', 'sokak_cadde_mahallekey',];

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'sokak_cadde_mahallekey', 'ilce_key');
    }
}
