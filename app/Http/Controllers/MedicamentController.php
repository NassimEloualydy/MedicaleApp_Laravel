<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicamentController extends Controller
{
    //
    public function insert_medicament(Request $r){
        // id	id_admin	code_medicament	desi	format	date_expiration	Stock_Min	Stock_actuel	prix
        if(Medicament::where(['code_medicament'=>$r->input('code')])->count()==0){

            if(Medicament::where(['desi'=>$r->input('desi'),'format'=>$r->input('format')])->count()==0){
                $M=new Medicament();
                $M->id_admin=session()->get('id');
                $M->code_medicament=$r->input('code');
                $M->desi=$r->input('desi');
                $M->format=$r->input('format');
                $M->date_expiration=$r->input('date_exp');
                $M->Stock_Min=$r->input('SM');
                $M->Stock_actuel=$r->input('SA');
                $M->prix=$r->input('prix');
                $M->save();
                return "valide";
            }else 
            return "Il existe un autre médicament avec la même Format et le même Designation !!";
        }else
        return "SVP cet code existe deja !!";

    }
    public function get_all_medicament(){
         $Medicament=DB::select("select id,code_medicament,desi,format,prix from medicament where id_admin=?",[session()->get('id')]);
        $s="";
        foreach($Medicament as $m){
            $s.="<tr><td>".$m->code_medicament."</td><td>".$m->desi."</td><td>".$m->format."</td><td>".$m->prix."</td><td><ion-icon class='icon_table icon_detail' onclick='detail_medicament(".$m->id.");' name='alert-circle-outline'></ion-icon></td><td><ion-icon class='icon_table icon_update' onclick='update_medicament(".$m->id.");' name='pencil-outline'></ion-icon></td><td><ion-icon class='icon_table icon_delete' onclick='delete_medicament(".$m->id.");' name='close-circle-outline'></ion-icon></td></tr>";
        }
        return $s;
    }
    public function delete_medicament(Request $r){
        $M=Medicament::where(['id_admin'=>session()->get('id'),'id'=>$r->input('id')])->get();
        $M[0]->delete();
        return "valide";
    }
    public function charger_medicament(Request $r){
        $M=Medicament::where(['id_admin'=>session()->get('id'),'id'=>$r->input('id')])->get();
        return $M[0];
    }
    public function update_medicament(Request $r){
        $M=Medicament::where(['id_admin'=>session()->get('id'),'id'=>$r->input('id')])->get();
        $M[0]->code_medicament=$r->input('code');
        $M[0]->desi=$r->input('desi');
        $M[0]->format=$r->input('format');
        $M[0]->date_expiration=$r->input('date_exp');
        $M[0]->Stock_Min=$r->input('SM');
        $M[0]->Stock_actuel=$r->input('SA');
        $M[0]->prix=$r->input('prix');
        $M[0]->save();
        return "valide";
      }
    public function chercher_medicament(Request $r){
        $q="select id,code_medicament,desi,format,prix from medicament where id_admin=? intersect (";
        $q.="select id,code_medicament,desi,format,prix from medicament where code_medicament like ? intersect (";
        $q.="select id,code_medicament,desi,format,prix from medicament where desi like ? intersect (";
        $q.="select id,code_medicament,desi,format,prix from medicament where format like ? intersect (";
        $q.="select id,code_medicament,desi,format,prix from medicament where prix like ? intersect (";
        $q.="select id,code_medicament,desi,format,prix from medicament where Stock_Min like ? intersect (";
        $q.="select id,code_medicament,desi,format,prix from medicament where Stock_actuel like ? ))))))";
        $Medicament=DB::select($q,[session()->get('id'),$r->input('code'),$r->input('desi'),$r->input('format'),$r->input('prix'),$r->input('SM'),$r->input('SA')]);
        $s="";
        foreach($Medicament as $m){
            $s.="<tr><td>".$m->code_medicament."</td><td>".$m->desi."</td><td>".$m->format."</td><td>".$m->prix."</td><td><ion-icon class='icon_table icon_detail' onclick='detail_medicament(".$m->id.");' name='alert-circle-outline'></ion-icon></td><td><ion-icon class='icon_table icon_update' onclick='update_medicament(".$m->id.");' name='pencil-outline'></ion-icon></td><td><ion-icon class='icon_table icon_delete' onclick='delete_medicament(".$m->id.");' name='close-circle-outline'></ion-icon></td></tr>";
        }
        return $s;
    }
    public function detail_medicament(Request $r){
        
        return $r;
    }
}
