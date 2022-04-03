<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
    use HasFactory;
    protected $table="rdv";
    protected $faillbale=["id_admin","id_patient","date","heure","status"];
}
