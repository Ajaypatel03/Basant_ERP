<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerEntry extends Model
{
    use HasFactory;
    protected $fillable = ['date','customer_id','items','type','amount_due','amount_paid'];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}