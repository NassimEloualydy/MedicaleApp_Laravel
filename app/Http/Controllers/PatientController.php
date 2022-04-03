<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Database\Console\DbCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    //
    public function get_all_patient(){
      //  <tr><td><img src='{{url($P->path_image)}}'  class='img_patient'></td><td>".$P->nom."</td><td>".$P->prenom."</td><td>".$P->cni."</td><td>".$P->tel."</td><td><ion-icon class='icon_table icon_detail' onclick='show_patient_detail(".$P->id.");' name='alert-circle-outline'></ion-icon></td><td><ion-icon class='icon_table icon_update' name='pencil-outline'></ion-icon></td><td><ion-icon class='icon_table icon_delete' name='close-circle-outline'></ion-icon></td></tr>
      $s="";
      $Pateints=Patient::where('id_admin',session()->get('id'))->orderBy('created_at','desc')->get();
      foreach($Pateints as $P)
      $s.="<tr><td><img src=".url($P->path_image)." class='img_patient'></td><td>".$P->nom."</td><td>".$P->prenom."</td><td>".$P->cni."</td><td><ion-icon class='icon_table icon_detail' onclick='show_patient_detail();detail_patient(".$P->id.")' name='alert-circle-outline'></ion-icon></td><td><ion-icon class='icon_table icon_update' onclick='charger_patient(".$P->id.")' name='pencil-outline'></ion-icon></td><td><ion-icon class='icon_table icon_delete' onclick='delete_patient(".$P->id.")' name='close-circle-outline'></ion-icon></td></tr>";
      return $s;
    }
    public function Ajouter_patient(Request $r){
        $s="";
               if(Patient::where('cni',$r->input('cni'))->count()==0){
            if(Patient::where(['nom'=>$r->input('nom'),'prenom'=>$r->input('prenom')])->count()==0){
              if(Patient::where('tel',$r->input('tel'))->count()==0){
                $P=new Patient();
                $P->nom=$r->input('nom');
                $P->prenom=$r->input('prenom');
                $P->tel=$r->input('tel');
                $P->cni=$r->input('cni');
                $P->adresse=$r->input('adresse');
                $P->id_admin=session()->get('id');
                $P->date_naissance=$r->input('date');
               $ext=explode('.',$r->file('img')->getClientOriginalName());
               $r->file('img')->storeAs('patients',$r->input('nom').'_'.$r->input('prenom').'.'.$ext[1],'public');
               $P->path_image='storage/patients/'.$r->input('nom').'_'.$r->input('prenom').'.'.$ext[1];
               $P->save();
               $s= "valide";
                
            }else
            $s="cet telephone exist deja !!";              
            }else 
        $s="le nom et le prenom de cet patient  il existe déjà !!";
        }else
    $s="ce cni exist deja !!";
    return $s;
    }
    public function delete_patient(Request $r){
        $P=Patient::find($r->input('id'));
        if(file_exists(public_path($P->path_image)))
        File::delete(public_path($P->path_image));
        $P->delete();
        return "valide";
       
    }
    public function charger_patient(Request $r){
        $P=Patient::find($r->input('id'));
        return $P;
    }
    public function MAJ_patient(Request $r){
        $P=Patient::find($r->input('id'));
        $s="";
        if($r->has('img')==1){
            //delete path image
            if(file_exists(public_path($P->path_image)))
            File::delete(public_path($P->path_image));
            //insert the new one
            $ext=explode('.',$r->file('img')->getClientOriginalName());
            $r->file('img')->storeAs('patients',$r->input('nom').'_'.$r->input('prenom').'.'.$ext[1],'public');
            $P->path_image="storage/patients/".$r->input('nom').'_'.$r->input('prenom').'.'.$ext[1];
        }
        $P->nom=$r->input('nom');
        $P->prenom=$r->input('prenom');
        $P->tel=$r->input('tel');
        $P->cni=$r->input('cni');
        $P->adresse=$r->input('adresse');
        $P->id_admin=session()->get('id');
        $P->date_naissance=$r->input('date');
        $P->save();
        return "valide";

    }
    public function chercher_patient(Request $r){
       $query="select * from patient where nom like ? intersect (select * from patient where prenom like ? intersect (select * from patient where cni like ? intersect (select * from patient where adresse like ?  intersect (select * from patient where tel like ? intersect (select * from patient where date_naissance like ? intersect (select * from patient where id_admin like ?))))))";
       $Pateints=DB::select($query,['%'.$r->input('nom').'%','%'.$r->input('prenom').'%','%'.$r->input('cni').'%','%'.$r->input('adresse').'%','%'.$r->input('tel').'%','%'.$r->input('date').'%' ,session()->get('id')]); 
       $s="";
       foreach($Pateints as $P)
       $s.="<tr><td><img src=".url($P->path_image)." class='img_patient'></td><td>".$P->nom."</td><td>".$P->prenom."</td><td>".$P->cni."</td><td><ion-icon class='icon_table icon_detail' onclick='show_patient_detail();detail_patient(".$P->id.")' name='alert-circle-outline'></ion-icon></td><td><ion-icon class='icon_table icon_update' onclick='charger_patient(".$P->id.")' name='pencil-outline'></ion-icon></td><td><ion-icon class='icon_table icon_delete' onclick='delete_patient(".$P->id.")' name='close-circle-outline'></ion-icon></td></tr>";

 

       return $s;
    }
    public function detail_patient(Request $r){
        $P=Patient::where(['id'=>$r->input('id'),'id_admin'=>session()->get('id')])->get();
        return $P[0];
    }
}
