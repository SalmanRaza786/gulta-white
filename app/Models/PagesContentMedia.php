<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesContentMedia extends Model
{
    use HasFactory;
    protected $fillable=['mediable_type', 'mediable_id','file_path','file_type'];
}
