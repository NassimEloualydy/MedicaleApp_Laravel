<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisiteController extends Controller
{
    //
  public function insert_visite(Request $r){
      $p=null;
    if($r->input('patient_by')=="Nom & prenom"){
        $T=explode(" ",$r->input("patient_value"));
        if(Patient::where(['nom'=>$T[0],'prenom'=>$T[1]])->count()==1){
            $p=Patient::where(['nom'=>$T[0],'prenom'=>$T[1]])->get();
        }
    }else{
        if(Patient::where($r->input('patient_by'),$r->input('patient_value'))->count()==1){
            $p=Patient::where($r->input('patient_by'),$r->input('patient_value'))->get();
        }
    }
      if($p!=null){
        if(!DB::select('select * from visite where date like ? and fin > ? and debut < ? and id_admin = ? ',[$r->input('date'),$r->input('debut'),$r->input('fin'),session()->get('id')])){
        $v=new Visite();
        $v->id_admin=session()->get('id');
        $v->id_patient=$p[0]->id;
        $v->debut=$r->input('debut');
        $v->fin=$r->input('fin');
        $v->date=$r->input('date');
        $v->desc=$r->input('desc');
        $v->prix=$r->input('prix');
        $v->save();
        return "valide";
  
      }else 
      return "la durée de début au de fin est invalide !!";
        
      }     
    return "untroubable !!";
  }
  public function get_all_visits(){
   
   $visite=DB::select("select v.id,p.path_image,p.nom,p.prenom,v.date,v.prix from visite v inner join patient p on p.id=v.id_patient where p.id_admin = ? and p.id_admin = ?",[session()->get('id'),session()->get('id')]);
   $s="";
   foreach ($visite as $v) {
     # code...
     $s.="<tr><td><img src=".url($v->path_image)." class='img_patient'></td><td>".$v->nom."</td><td>".$v->prenom."</td><td>".$v->date."</td><td>".$v->prix."</td><td><ion-icon class='icon_table icon_detail' onclick='show_visite_detail();detail_visite(".$v->id.")' name='alert-circle-outline'></ion-icon></td><td><ion-icon class='icon_table icon_update' onclick='charger_visite(".$v->id.")' name='pencil-outline'></ion-icon></td><td><ion-icon class='icon_table icon_delete' onclick='delete_visite(".$v->id.")' name='close-circle-outline'></ion-icon></td></tr>";
   }
   return $s;
  }
  public function delete_visite(Request $r){
    $v=Visite::where(['id'=>$r->input('id'),'id_admin'=>session()->get('id')])->get();
    $v[0]->delete();
    return "valide";
  }
  public function charger_visite(Request $r){
    $v=DB::select('select v.id,p.cni,v.debut,v.fin,v.prix,v.date,v.desc from patient p inner join visite v on v.id_patient=p.id where p.id_admin= ? and v.id_admin=? and  v.id= ?',[session()->get('id'),session()->get('id'),$r->input('id')]);
    return $v[0];
  }
  public function update_visite(Request $r){
    $v=Visite::where(['id'=>$r->input('id'),'id_admin'=>session()->get('id')])->get();
    if(!DB::select('select * from visite where date like ? and fin > ? and debut < ? and id_admin = ? and id!= ?',[$r->input('date'),$r->input('debut'),$r->input('fin'),session()->get('id'),$r->input('id')])){

      $v[0]->debut=$r->input('debut');
      $v[0]->fin=$r->input('fin');
      $v[0]->date=$r->input('date');
      $v[0]->desc=$r->input('desc');
      $v[0]->prix=$r->input('prix');
      $v[0]->save();
      return "valide";
    }else
    return "la durée de début au de fin est invalide !!";


  }
  public function detail_visite(Request $r){
    //$v=Visite::where(['id'=>$r->input('id'),'id_admin'=>session()->get('id')])->get();
     $v=DB::select('select v.*,p.* from visite v inner join patient p on p.id=v.id_patient where v.id= ? and v.id_admin= ? ',[$r->input('id'),session()->get('id')]);
    return $v[0];
    // test if im exist into another visite 
  }
  public function search_visite(Request $r){
    $data['id_admin']='%'.session()->get('id').'%';
    $query=" select v.id,p.path_image,p.nom,p.prenom,v.date,v.prix from visite v inner join patient p on p.id=v.id_patient where p.id_admin = ? intersect ( ";

    if($r->input('patient_by')=="Nom & prenom"){
      $T=explode(' ',$r->input('patient_value'));
      $data['nom']='%'.$T[0].'%';
      $data['prenom']='%'.$T[1].'%';
      $query.=" select v.id,p.path_image,p.nom,p.prenom,v.date,v.prix from visite v inner join patient p on p.id=v.id_patient where p.nom like ? and p.prenom like ? intersect( ";
    }
    else{
      $data[$r->input('patient_by')]='%'.$r->input('patient_value').'%';
      $query.=" select v.id,p.path_image,p.nom,p.prenom,v.date,v.prix from visite v inner join patient p on p.id=v.id_patient where ".$r->input('patient_by')." like ? intersect( ";
    }
    $data['date']='%'.$r->input('date').'%';
    $data['prix']='%'.$r->input('prix').'%';
    $data['debut']='%'.$r->input('debut').'%';
    $data['fin']='%'.$r->input('fin').'%';
    $query.=" select v.id,p.path_image,p.nom,p.prenom,v.date,v.prix from visite v inner join patient p on p.id=v.id_patient where v.date  like ? intersect (";
    $query.=" select v.id,p.path_image,p.nom,p.prenom,v.date,v.prix from visite v inner join patient p on p.id=v.id_patient where v.prix  like ? intersect (";
    $query.=" select v.id,p.path_image,p.nom,p.prenom,v.date,v.prix from visite v inner join patient p on p.id=v.id_patient where v.debut  like ? intersect (";
    $query.=" select v.id,p.path_image,p.nom,p.prenom,v.date,v.prix from visite v inner join patient p on p.id=v.id_patient where v.fin  like ?)))))";
    $visite=null;
    if($r->input('patient_by')=="Nom & prenom")
      $visite=DB::select($query,[session()->get('id'),$data['nom'],$data['prenom'],$data['date'],$data['prix'],$data['debut'],$data['fin']]);
    else
    $visite=DB::select($query,[session()->get('id'),$data[$r->input('patient_by')],$data['date'],$data['prix'],$data['debut'],$data['fin']]);
    $s="";
   foreach ($visite as $v) {
     # code...
     $s.="<tr><td><img src=".url($v->path_image)." class='img_patient'></td><td>".$v->nom."</td><td>".$v->prenom."</td><td>".$v->date."</td><td>".$v->prix."</td><td><ion-icon class='icon_table icon_detail' onclick='show_visite_detail();detail_visite(".$v->id.")' name='alert-circle-outline'></ion-icon></td><td><ion-icon class='icon_table icon_update' onclick='charger_visite(".$v->id.")' name='pencil-outline'></ion-icon></td><td><ion-icon class='icon_table icon_delete' onclick='delete_visite(".$v->id.")' name='close-circle-outline'></ion-icon></td></tr>";
   }
   return $s;  
  }
}
