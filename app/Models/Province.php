<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'sehir';
    protected $primaryKey = 'sehir_id';
    protected $fillable = ['sehir_title', 'sehir_key'];

    public function districts()
    {
        return $this->hasMany(District::class, 'ilce_sehirkey', 'sehir_key');
    }
}
