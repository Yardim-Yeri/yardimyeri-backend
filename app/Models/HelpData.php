<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpData extends Model
{
    use HasFactory;

    public function ilce() {
        return \DB::table('ilce')->where('ilce_key', $this->ilce_id)->first();
    }

    public function mahalle() {
        return \DB::table('ilce')->where('ilce_key', $this->ilce_id)->first();
    }

    public function getAdresAttribute() {
        $sehir = $this->sehir;
        $ilce = \DB::table('ilce')->where('ilce_key', $this->ilce_id)->first();
        $mahalle = \DB::table('mahalle')->where('mahalle_key', $this->mahalle_id)->first();
        $sokak = \DB::table('sokak_cadde')->where('sokak_cadde_id', $this->sokak_id)->first();
        
        return $sehir . ' ' . $ilce->ilce_title . ' İlçesi ' . ($mahalle->mahalle_title ?? '') . ' Mah. ' . ($sokak->sokak_cadde_title ?? '') . ' ' . ($this->apartman ?? '');
    }

    public function helper(){
        return $this->hasOne(HelperData::class);
    }
}
