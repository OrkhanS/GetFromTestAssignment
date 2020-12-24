<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    private $name;
    private $description;
    private $user_id;
    private $totalprice;

    public function purchase()
    {
        return $this->belongsTo(Customer::class);
    }
}
