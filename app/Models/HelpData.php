<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HelpData extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'tel',
        'ihtiyac_turu',
        'ihtiyac_turu_detayi',
        'kac_kisilik',
        'sehir',
        'ilce_id',
        'mahalle_id',
        'sokak_id',
        'apartman',
        'adres_tarifi',
        'lat',
        'lng',
    ];

    // relationship
    public function ilce()
    {
        return \DB::table('ilce')->where('ilce_key', $this->ilce_id)->first();
    }

    public function mahalle()
    {
        return \DB::table('ilce')->where('ilce_key', $this->ilce_id)->first();
    }

    public function helper()
    {
        return $this->hasOne(HelperData::class);
    }

    // attributes
    public function getAdresAttribute()
    {
        $sehir = $this->sehir;
        $ilce = \DB::table('ilce')->where('ilce_key', $this->ilce_id)->first();
        $mahalle = \DB::table('mahalle')->where('mahalle_key', $this->mahalle_id)->first();
        $sokak = \DB::table('sokak_cadde')->where('sokak_cadde_id', $this->sokak_id)->first();

        return $sehir . ' ' . $ilce->ilce_title . ' İlçesi ' . ($mahalle->mahalle_title ?? '') . ' Mah. ' . ($sokak->sokak_cadde_title ?? '') . ' ' . ($this->apartman ?? '');
    }

    // scopes
    public function scopeFilter($q)
    {
        if (request()->filled('ihtiyac_turu')) {
            $q->where('ihtiyac_turu', request()->input('ihtiyac_turu'));
        }

        if (request()->filled('sehir')) {
            $q->where('sehir', mb_strtoupper(request()->input('sehir')));
        }

        // status
        if (request()->filled('help_status')) {
            $q->where('help_status', request()->input('help_status'));
        }

        // kac_kisilik
        if (request()->filled('kac_kisilik')) {
            $q->where('kac_kisilik', request()->input('kac_kisilik'));
        }

        return $q;
    }
}
