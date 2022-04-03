<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
      protected $table="patient";
        protected $faillbale=['nom','prenom','cni','adresse','date_naissance','tel','path_image','id_admin'];
}
