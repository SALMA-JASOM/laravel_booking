<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use CrudTrait;
    protected $fillable = ['property_id', 'name', 'email', 'phone', 'message', 'visit_date', 'visit_time','payment_status'];

}
