<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrdonnance extends Model
{
    use HasFactory;
    protected $faillball=["id","id_admin","id_medicament","id_ordonnance"];
}
