<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCode extends Model
{

    use HasFactory;
    protected $fillable=['p_id','p_codes','is_verify','batch_no'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'p_id', 'id');
    }


    public function getIsVerifyAttribute($value)
    {
        if($value==1){
            $getVal='Verify';
        }
        if($value==2){
            $getVal='Pending';
        }

        return $getVal;
    }
}
