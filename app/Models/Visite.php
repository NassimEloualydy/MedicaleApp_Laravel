<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;
    protected $table ="visite";
    protected $failball=['id_admin','id_patient','debut','fin','desc','prix','date'];
}
