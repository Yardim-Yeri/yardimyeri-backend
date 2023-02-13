<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelperData extends Model
{
    use HasFactory;

    public function help()
    {
        return $this->belongsTo(HelpData::class, 'help_data_id', 'id');
    }
}
