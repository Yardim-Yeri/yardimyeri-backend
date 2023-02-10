<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'ilce';
    protected $primaryKey = 'ilce_id';
    protected $fillable = ['ilce_title', 'ilce_key', 'ilce_sehirkey'];

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class, 'mahalle_ilcekey', 'ilce_key');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'ilce_sehirkey', 'sehir_key');
    }
}
