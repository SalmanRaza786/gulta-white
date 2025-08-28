<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesContent extends Model
{
    use HasFactory;
    protected $fillable=['title','description','page_type'];

    public function pageMedia()
    {
        return $this->morphMany(PagesContentMedia::class, 'mediable');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($invoice) {

            $invoice->pageMedia()->delete();
        });
    }
}
