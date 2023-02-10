<?php

namespace App\Http\Controllers;

use App\Models\HelpData;
use App\Models\HelperData;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function yardimTalebimVar()
    {
        return view('yardim_talebim_var');
    }

    public function yardimdaBulunabilirim(Request $request, $id = null)
    {
        if (!empty($id)) {
            return $this->yardimdaBulunabilirimShow($id);
        }

        $success_count = HelpData::where('help_status', '=', 'Yardım Ulaştı')->count();
        $warning_count = HelpData::where('help_status', '=', 'Yardım Bekliyor')->count();
        $info_count = HelpData::where('help_status', '=', 'Yardım Geliyor')->count();
        $data = HelpData::where('help_status', '!=', 'Yardım Ulaştı')
            ->filter()
            ->orderBy('created_at', 'DESC')
            ->paginate(20)
            ->withQueryString();

        if ($request->has('old_page')) {
            return view('yardimda-bulunabilirim-old', compact('data', 'success_count', 'warning_count', 'info_count'));
        }

        return view('yardimda_bulunabilirim', compact('data', 'success_count', 'warning_count', 'info_count'));
    }

    public function yardimdaBulunabilirimShow($id)
    {
        $item = HelpData::findOrFail($id);

        $helpers = collect();
        if ($item->help_status != 'Yardım Bekliyor') {
            $helpers = HelperData::where('help_data_id', $item->id)->get();
        }

        return view('yardimda_bulunabilirim_show', compact('item', 'helpers'));
    }
}
