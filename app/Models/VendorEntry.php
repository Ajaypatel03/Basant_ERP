<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorEntry extends Model
{
    use HasFactory;

    protected $fillable = ['date','due_date','vendor_id','bill_no','amount_due','amount_paid'];

    public function vendor(){
       return $this->belongsTo(Vendor::class);
    }
}