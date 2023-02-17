<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsData extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sms_data';

    protected $fillable = [
        'phone',
        'message',
        'status', // 1: sent, 2: failed
        'case_id',
        'data'
    ];

}
