<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;

    protected $table = 'mahalle';
    protected $primaryKey = 'mahalle_id';
    protected $fillable = ['mahalle_title', 'mahalle_key', 'mahalle_ilcekey'];

    public function neighborhoods()
    {
        return $this->hasMany(Street::class, 'sokak_cadde_mahallekey', 'mahalle_key');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'mahalle_ilcekey', 'ilce_key');
    }
}
