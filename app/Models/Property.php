<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use CrudTrait;
    protected $fillable = ['title', 'description', 'price', 'location', 'type','beds','baths'];

}
