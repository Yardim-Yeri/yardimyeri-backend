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
            $row->sehir,
            $row->ihtiyac_turu,
            sprintf('%d Kişilik', $row->kac_kisilik),
            $row->created_at->format('d-m-Y H:i'),
            $row->tel,
            $row->adres,
            $row->help_status,
            URL::route('yardimda-bulunabilirim', ['id' => $row->id]),
        ];
    }
}
