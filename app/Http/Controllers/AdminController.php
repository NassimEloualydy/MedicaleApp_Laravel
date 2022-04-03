<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    //


    public function login(Request $r){
        $A=Admin::where(['login'=>$r->input('login')],['pw',$r->input('pw')])->get();
        if($A->count()==1){
            session(['id'=>$A[0]->id]);
            session(['nom'=>$A[0]->nom]);
            session(['prenom'=>$A[0]->prenom]);
            session(['login'=>$A[0]->login]);
            session(['pw'=>$A[0]->pw]);
            session(['path'=>$A[0]->path_image]);
            return "valide";     
        }
        return "le login au le mot de passe est introuvable !!";

    }
    public function inscrire(Request $r){
        $s="";
        if(Admin::where(['nom'=>$r->input('nom')],['prenom'=>$r->input('prenom')])->count()==0){
        if(Admin::where('login',$r->input('login'))->count()==0){
        if(Admin::where('pw',$r->input('pw'))->count()==0){
       $A=new Admin();
       $A->nom=$r->input('nom');
       $A->prenom=$r->input('prenom');
       $A->login=$r->input('login');
       $A->pw=$r->input('pw');
       $ext=explode('.',$r->file('img')->getClientOriginalName());
       $A->path_image="storage/admins/".$r->input('nom').'_'.$r->input('prenom').'.'.$ext[1];
       $r->file('img')->storeAs('admins',$r->input('nom').'_'.$r->input('prenom').'.'.$ext[1],'public');
       $A->save();
       session(['id'=>$A->id]);
       session(['nom'=>$A->nom]);
       session(['prenom'=>$A->prenom]);
       session(['login'=>$A->login]);
       session(['pw'=>$A->pw]);
       session(['path'=>$A->path_image]);
       $s="valide";
    }else
    $s="ce mot de passe existe déjà !!";
}else 
     $s="ce login existe déjà !!";
} else
     $s="changer le nom au le prenom !!";
     return $s;
       }
 public function MAJ_admin(Request $r){
     $A=Admin::find(session()->get('id'));
     if(Admin::where(['nom'=>$r->input('nom'),'prenom'=>$r->input('prenom')])->count()==0 || $r->input('nom').'_'.$r->input('prenom')==$A->nom.'_'.$A->prenom){
          if(Admin::where('login',$r->input('login'))->count()==0 || $r->input('login')==$A->login){
              if(Admin::where('pw',$r->input('pw'))->count()==0 || $r->input('pw')==$A->pw){
                        
            $A->nom=$r->input('nom');
            $A->prenom=$r->input('prenom');
            $A->login=$r->input('login');
            $A->pw=$r->input('pw');
            if($r->has('img')==1){
                //   //delete the image
                if(file_exists(public_path($A->path_image))){      
                  File::delete(public_path($A->path_image));
           //   //insert the new         
               }
               $img_new=explode('.',$r->file('img')->getClientOriginalName());
             $r->file('img')->storeAs('admins',$r->input('nom').'_'.$r->input('prenom').'.'.$img_new[1],'public');
             $A->path_image="storage/admins/".$r->input('nom').'_'.$r->input('prenom').'.'.$img_new[1];
         
            }
            $A->save();
            session(['id'=>$A->id]);
            session(['nom'=>$A->nom]);
            session(['prenom'=>$A->prenom]);
            session(['path'=>$A->path_image]);     
           return "valide";
        }else
        return "ce login existe déjà !! essayer un autre";

          }
          return "ce login existe déjà !! essayer un autre";
     }
     return "ce nom et ce prénom existe déjà !! Essayé un autre";

 }
 public function charger_admin(){
    $data=["nom"=>session()->get('nom'),"prenom"=>session()->get('prenom'),"login"=>session()->get('login'),"pw"=>session()->get('pw'),"path"=>session()->get('path')];
    return $data;
 }
}
