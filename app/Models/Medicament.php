<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;
    protected $table="medicament";
    protected $faillball=['id_admin','code_medicament','desi','format','date_expiration','Stock_Min','Stock_actuel','prix'];
}
