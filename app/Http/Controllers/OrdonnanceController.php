<?php

namespace App\Http\Controllers;

use App\Models\DetailOrdonnance;
use App\Models\Medicament;
use App\Models\Ordonnance;
use App\Models\Patient;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Catch_;

class OrdonnanceController extends Controller
{
    //
    public function get_medicament_ordonnance(){
        $Medicament=Medicament::where(["id_admin"=>session()->get('id')])->orderBy('id','desc')->get();
        $s="";
        foreach($Medicament as $m){    
            $s.="<div class='item_medicamment_ordonnance' onclick='AddToPanier($m->id,\"$m->code_medicament\",\"$m->desi\",\"$m->format\")'> 
                       <span class='ticket_MO'>Code :</span><span class='value_MO' id='codeMedicament_ordonnance'>$m->code_medicament</span><br>
                       <span class='ticket_MO'>Designation :</span><span class='value_MO' id='codeMedicament_ordonnance'>$m->desi</span><br>
                       <span class='ticket_MO'>Format :</span><span class='value_MO' id='codeMedicament_ordonnance'>$m->format</span>
                       </div>";
        }
        return $s; 
    }
    public function get_medicament(Request $r){
        $Medicament=Medicament::where($r->input('m_by'),'like',$r->input('m_value'))->orderBy('id','desc')->get();
   //    $Medicament=DB::select("select * from medicament where $r->input('m_by') like ? ",[$r->input('m_value')]);
       $s="";
        foreach($Medicament as $m){    
            $s.="<div class='item_medicamment_ordonnance' onclick='AddToPanier($m->id,\"$m->code_medicament\",\"$m->desi\",\"$m->format\")'> 
                       <span class='ticket_MO'>Code :</span><span class='value_MO' id='codeMedicament_ordonnance'>$m->code_medicament</span><br>
                       <span class='ticket_MO'>Designation :</span><span class='value_MO' id='codeMedicament_ordonnance'>$m->desi</span><br>
                       <span class='ticket_MO'>Format :</span><span class='value_MO' id='codeMedicament_ordonnance'>$m->format</span>
                       </div>";
        }
        return $s; 
   
    }
    public function add_ordonnance(Request $r){
    $p=null;
    if($r->input('p_by')=="Nom & prenom"){
       $T=explode(" ",$r->input('p_value'));
       $p=Patient::where(["nom"=>$T[0],"prenom"=>$T[1]])->get();
    }else{
       $p=Patient::where([$r->input("p_by")=>$r->input("p_value")])->get();
          
    }
    // $P=explode(",",$r->input('Panier'));
    // for($i=0;$i<count($P);$i+3){
    // }
    if(count($p)==1){
        try{
            $o=new Ordonnance();
            $o->id_admin=session()->get('id');
            $o->date=$r->input('date_ordonnance');
            $o->id_patient=$p[0]->id;
            $o->path="";
            $o->save();
    //  // for"id","id_admin","id_medicament","id_ordonnance"
      $Ts=explode(",",$r->input('Panier'));
      for($i=0;$i<count($Ts);$i++){
          $d=new DetailOrdonnance();
          $d->id_admin=session()->get('id');
          $d->id_medicament=$Ts[$i];
          $d->id_ordonnance=$o->id; 
          $d->save();   
    } 
          //"id","id_admin","id_medicament","id_ordonnance"
    // $d->
    //"id","id_admin","id_medicament","id_ordonnance"      
    return "valide";
      
        }Catch(Exception $e){
            return $e->getMessage();
        }
     
  
 
    }else 
    return "Patient introuvable !!";    
    }
    public function get_ordonnance(){
        $ordonnance=DB::select("select o.id,p.cni,p.nom,p.prenom,o.date from ordonnance o inner join patient p on p.id=p.id_admin where p.id_admin=? order by o.id desc ",[session()->get('id')]);
        $s="";
        foreach($ordonnance as $o){
            $s.="<tr><td>$o->cni</td><td>$o->nom</td><td>$o->prenom</td><td>$o->date</td><td><ion-icon class='icon_table icon_detail' onclick='detail_ordonnance($o->id)' onclick='show_patient_detail();' name='alert-circle-outline'></ion-icon></td><td><ion-icon onclick='charger_ordonnance($o->id)' class='icon_table icon_update' name='pencil-outline'></ion-icon></td><td><ion-icon onclick='delete_ordonnance($o->id)' class='icon_table icon_delete' name='close-circle-outline'></ion-icon></td></tr>";
        }
   return $s;
    }
    public function delete_ordonnance(Request $r){
        $o=Ordonnance::where('id',$r->input('id'))->get();
        $o[0]->delete();
        return "valide";
    }
    public function charger_ordonnance(Request $r){
        $o=DB::select("select o.id,p.cni,p.nom,p.prenom,o.date FROM ordonnance o inner join patient p on p.id=o.id_patient where o.id=? ",[$r->input('id')]);
        $m=DB::select("select m.id,m.code_medicament,m.desi,m.format from medicament m inner join detail_ordonnances d on d.id_medicament=m.id where d.id_ordonnance= ?",[$r->input('id')]);
        $data["ordonnance"]=$o;
        $data["medicament"]=$m;
        return json_encode($data);
    }
    public function update_ordonnance(Request $r){
        try{
            $o=Ordonnance::where(["id"=>$r->input('id'),"id_admin"=>session()->get('id')])->get();
            $o[0]->date=$r->input('date_ordonnance');
            $o[0]->save();
            $D=DetailOrdonnance::where(["id_ordonnance"=>$o[0]->id,"id_admin"=>session()->get('id')])->get();
            foreach($D as $d){
                $d->delete();
            }
            $Ts=explode(",",$r->input('Panier'));
            for($i=0;$i<count($Ts);$i++){
                $d=new DetailOrdonnance();
                $d->id_admin=session()->get('id');
                $d->id_medicament=$Ts[$i];
                $d->id_ordonnance=$o[0]->id; 
                $d->save();   
          } 
        
       return "valide";
    
        }Catch(Exception $e){
            return $e->getMessage();
        }
    }

}
