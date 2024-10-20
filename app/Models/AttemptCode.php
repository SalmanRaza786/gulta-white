<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttemptCode extends Model
{
    use HasFactory;
    protected $fillable =['name','phone','p_code','is_valid','p_id'];

    public function pCode()
    {
        return $this->belongsTo(ProductCode::class, 'p_code', 'p_codes');
    }

    public function getIsValidAttribute($value)
    {
        if($value==1){
            $getVal='Valid';
        }
        if($value==2){
            $getVal='Invalid';
        }

        return $getVal;
    }

}
