<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangerDetail extends Model
{
    use HasFactory;

    protected $table = 'changer_details';

    protected $guarded = [];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'id_product');
    }
}
