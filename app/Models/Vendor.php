<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = ['v_name','v_mobile','v_address','v_bank_name','v_bank_acc_no','v_ifsc','v_bank_location'];
}