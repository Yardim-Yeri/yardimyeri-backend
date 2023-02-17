<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;
    protected $table = 'tweets';


    protected $fillable = [
        'tweet_id',
        'case_id',
        'tweet_text',
        'status', // 0: removed, 1: published, 2: not published
        'data' // json
    ];

    public function case()
    {
        return $this->belongsTo(HelpData::class, 'case_id', 'id');
    }
}
