<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $table = 'tweet';
    protected $primaryKey = 'id';
    protected $fillable = ['tweet_content', 'case_id','status','tweet_id','data'];
}
