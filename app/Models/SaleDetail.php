<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $table = 'sale_details';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class,'id_product','id');
    }

    
    public function member()
    {
        return $this->belongsTo(Member::class,'id_member','id');
    }
}
