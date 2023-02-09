<?php

namespace App;

use App\Models\HelpData;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class HelpDataExport implements FromCollection, ShouldAutoSize, WithMapping
{
    public function collection()
    {
        return HelpData::all();
    }

    public function map($row): array
    {
        return [
            $row->name,
            \DB::table('sehir')
                ->select('sehir_title')
                ->where('sehir_key', '=', $row->sehir)
                ->first()
                ->sehir_title,
            $row->ihtiyac_turu,
            sprintf('%d kisilik', $row->kac_kisilik),
            $row->help_status,
            URL::route('yardimda-bulunabilirim', ['id' => $row->id]),
        ];
    }
}
