<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    use HasFactory;

    protected $table = 'sms';
    protected $primaryKey = 'id';
    protected $fillable = ['sms_content', 'case_id','recieve_number','provider_response','data'];
}
