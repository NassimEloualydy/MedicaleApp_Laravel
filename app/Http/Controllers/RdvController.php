<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Rdv;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RdvController extends Controller
{

    //
    public function insert_RDV(Request $r){
   
        $p=null;
        if($r->input('patient_by')=="Nom & prenom"){
            $T=explode(' ',$r->input('patient_value')); 
            if(Patient::where(['nom'=>$T[0],'prenom'=>$T[1]])->count()==1)
            $p=Patient::where(['nom'=>$T[0],'prenom'=>$T[1]])->get();    
            else
            $p=null;    
        }
        else
        {
            if(Patient::where([$r->input('patient_by')=>$r->input('patient_value')])->count()==1)
            $p=Patient::where([$r->input('patient_by')=>$r->input('patient_value')])->get();

            else
            $p=null;    
    
        }
        if($p!=null){
        $rdv=new Rdv();
        $rdv->id_admin=session()->get('id');
        $rdv->id_patient=$p[0]->id;
        $rdv->status=$r->input('status');
        $rdv->date=$r->input('date');
        $rdv->heure=$r->input('heure');
        $rdv->save();
        return "valide";
        }else
        return "SVP le patient est introuvable !!";
        
    }
    // <div class='container_rdv_item'> <br>


//     <div class='container_rdv_item '><br> <div class='item_rdv_container'>  <div class='box_item_rdv box_item_rdv_img'><img src='images/login1.png' class='img_RDV_patient'>
//     <br><p>Nassim Eloualydy</p><br></div><div class="box_item_rdv box_item_rdv_table"><table><tr>
//      <th>Date</th><td>2000-10-20</td></tr><tr><th>Temps</th><td>14:30</td></tr><tr><th>Status</th><td>Attende</td></tr></table>
//      <ion-icon class='icon_table icon_update'  name='pencil-outline'></ion-icon>
//      <ion-icon class='icon_table icon_delete' name='close-circle-outline'></ion-icon></div>  </div>  <br>

//</div>
public function get_all_rdv(){
  $rdvs=Rdv::select(['rdv.*','patient.nom','patient.prenom','patient.path_image'])->join('patient','patient.id','=','rdv.id_patient')->where(['rdv.id_admin'=>session()->get('id'),'patient.id_admin'=>session()->get('id')])->orderBy('created_at','desc')->get();  
  $k=0;
  $s="";
  foreach($rdvs as $rdv){
        if($k==0){
     $s.="<div class='container_rdv_item '><br> <div class='item_rdv_container'>  <div class='box_item_rdv box_item_rdv_img'><img src='".url($rdv->path_image)."' class='img_RDV_patient'><br><p>".$rdv->nom." ".$rdv->prenom."</p><br></div><div class='box_item_rdv box_item_rdv_table'><table><tr>";
     $s.="<th>Date</th><td>".$rdv->date."</td></tr><tr><th>Temps</th><td>".$rdv->heure."</td></tr><tr><th>Status</th><td>".$rdv->status."</td></tr></table>";
     $s.="<ion-icon class='icon_table icon_update' onclick='charger_rdv(".$rdv->id.",".$rdv->id_admin.",".$rdv->id_patient.")' name='pencil-outline'></ion-icon>&nbsp;";
     $s.="<ion-icon class='icon_table icon_delete' onclick='delete_rdv(".$rdv->id.",".$rdv->id_admin.",".$rdv->id_patient.")' name='close-circle-outline'></ion-icon></div></div><br>";
            $k=1;
        }else{
            $s.="<br> <div class='item_rdv_container'>  <div class='box_item_rdv box_item_rdv_img'><img src='".url($rdv->path_image)."' class='img_RDV_patient'><br><p>".$rdv->nom." ".$rdv->prenom."</p><br></div><div class='box_item_rdv box_item_rdv_table'><table><tr>";
            $s.="<th>Date</th><td>".$rdv->date."</td></tr><tr><th>Temps</th><td>".$rdv->heure."</td></tr><tr><th>Status</th><td>".$rdv->status."</td></tr></table>";
            $s.="<ion-icon class='icon_table icon_update' onclick='charger_rdv(".$rdv->id.",".$rdv->id_admin.",".$rdv->id_patient.")' name='pencil-outline'></ion-icon>&nbsp;";
            $s.="<ion-icon class='icon_table icon_delete' onclick='delete_rdv(".$rdv->id.",".$rdv->id_admin.",".$rdv->id_patient.")' name='close-circle-outline'></ion-icon></div>  </div>  <br></div><br>";
            $k=0;
        }   
  }  
  if($k==1)
  $s.="</div><br>";
return $s;
}
public function delete_rdv(Request $r){
    $rdv=Rdv::where(['id'=>$r->input('id'),'id_admin'=>$r->input('id_admin'),'id_patient'=>$r->input('id_patient')])->get();
    $rdv[0]->delete();
    return "valide";
}
public function charger_rdv(Request $r){
    $rdv=Rdv::select(['rdv.*','patient.cni','patient.tel','patient.nom','patient.prenom'])->join('patient','patient.id','=','rdv.id_patient')->where(['rdv.id'=>$r->input('id'),'rdv.id_admin'=>$r->input('id_admin'),'rdv.id_patient'=>$r->input('id_patient')])->get();
    return $rdv[0];
}
public function MAJ_RDV(Request $r){
    // $rdv=Rdv::where(['id_patient'=>$r->input('patient_value'),''])
       $rdv=Rdv::where('id',$r->input('id_rdv'))->get();
       $rdv[0]->status=$r->input('status');
       $rdv[0]->date=$r->input('date');
       $rdv[0]->heure=$r->input('heure');
       $rdv[0]->save();
       return "valide";

}
public function chercher_rdv(Request $r){
    $p=null;
        if($r->input('patient_by')=="Nom & prenom"){
            $T=explode(' ',$r->input('patient_value')); 
            if(Patient::where(['nom'=>$T[0],'prenom'=>$T[1]])->count()==1)
            $p=Patient::where(['nom'=>$T[0],'prenom'=>$T[1]])->get();    
            else
            $p=null;    

        }
        else
        {
            if(Patient::where([$r->input('patient_by')=>$r->input('patient_value')])->count()==1)
            $p=Patient::where([$r->input('patient_by')=>$r->input('patient_value')])->get();

            else
            $p=null;    
    
        }
        if($p!=null || ($r->input('patient_value')=="")){
            $data=null;
            if($r->input('patient_by')=="Nom & prenom"){
                $T=explode(" ",$r->input('patient_value'));
                $data['nom']='%'.$T[0].'%';
                $data['prenom']='%'.$T[1].'%';
                $query="select p.nom,p.prenom,p.path_image,r.* from patient p inner JOIN rdv r on r.id_patient=p.id where p.nom like ? and p.prenom like ? intersect ";
    }else{
        $data[$r->input('patient_by')]='%'.$r->input('patient_value').'%';
        $query="select p.nom,p.prenom,p.path_image,r.* from patient p inner JOIN rdv r on r.id_patient=p.id where p.".$r->input('patient_by')." like ?  intersect ";
    }
//    $data=['%'.$r->input('date').'%','%'.$r->input('heure').'%','%'.$r->input('status').'%'];
    $data['date']='%'.$r->input("date").'%';
    $data['heure']='%'.$r->input("heure").'%';
    $data['status']='%'.$r->input("status").'%';
    $data['id_admin']=session()->get('id');
    $query.="(  select p.nom,p.prenom,p.path_image,r.* from patient p inner JOIN rdv r on r.id_patient=p.id where r.date like ? intersect (";
    $query.="select p.nom,p.prenom,p.path_image,r.* from patient p inner JOIN rdv r on r.id_patient=p.id where r.heure like ? intersect (";
    $query.="select p.nom,p.prenom,p.path_image,r.* from patient p inner JOIN rdv r on r.id_patient=p.id where r.status like ? and r.id_admin = ? )))";
   $rdvs=null;
    if(count($data)==6){
       $rdvs=DB::select($query,[$data['nom'],$data['prenom'],$data['date'],$data['heure'],$data['status'],$data['id_admin']]);
    }else{
        $rdvs=DB::select($query,[$data[$r->input('patient_by')],$data['date'],$data['heure'],$data['status'],$data['id_admin']]);
    }
    $k=0;
    $s="";
    foreach($rdvs as $rdv){
          if($k==0){
       $s.="<div class='container_rdv_item '><br> <div class='item_rdv_container'>  <div class='box_item_rdv box_item_rdv_img'><img src='".url($rdv->path_image)."' class='img_RDV_patient'><br><p>".$rdv->nom." ".$rdv->prenom."</p><br></div><div class='box_item_rdv box_item_rdv_table'><table><tr>";
       $s.="<th>Date</th><td>".$rdv->date."</td></tr><tr><th>Temps</th><td>".$rdv->heure."</td></tr><tr><th>Status</th><td>".$rdv->status."</td></tr></table>";
       $s.="<ion-icon class='icon_table icon_update' onclick='charger_rdv(".$rdv->id.",".$rdv->id_admin.",".$rdv->id_patient.")' name='pencil-outline'></ion-icon>&nbsp;";
       $s.="<ion-icon class='icon_table icon_delete' onclick='delete_rdv(".$rdv->id.",".$rdv->id_admin.",".$rdv->id_patient.")' name='close-circle-outline'></ion-icon></div></div><br>";
       $k=1;
          }else{
              $s.="<br> <div class='item_rdv_container'>  <div class='box_item_rdv box_item_rdv_img'><img src='".url($rdv->path_image)."' class='img_RDV_patient'><br><p>".$rdv->nom." ".$rdv->prenom."</p><br></div><div class='box_item_rdv box_item_rdv_table'><table><tr>";
              $s.="<th>Date</th><td>".$rdv->date."</td></tr><tr><th>Temps</th><td>".$rdv->heure."</td></tr><tr><th>Status</th><td>".$rdv->status."</td></tr></table>";
              $s.="<ion-icon class='icon_table icon_update' onclick='charger_rdv(".$rdv->id.",".$rdv->id_admin.",".$rdv->id_patient.")' name='pencil-outline'></ion-icon>&nbsp;";
              $s.="<ion-icon class='icon_table icon_delete' onclick='delete_rdv(".$rdv->id.",".$rdv->id_admin.",".$rdv->id_patient.")' name='close-circle-outline'></ion-icon></div>  </div>  <br></div><br>";
              $k=0;
          }   
    }  
    if($k==1)
    $s.="</div><br>";
    return $s;
}else
return "SVP le patient est introuvable !!";
}
}
