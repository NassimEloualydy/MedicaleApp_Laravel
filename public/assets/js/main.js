const List_Memebrs =document.querySelectorAll('.box_item');
var ob=new IntersectionObserver(function(entries,apears){
entries.forEach(entry=>{
if(!entry.isIntersecting)
return;
else{
    entry.target.classList.add('appear');
    ob.unobserve(entry.target);
}
});
});
var r=0;
function compt_user(){
    if(r==0){

//
        document.querySelectorAll('.comp_user')[0].style.right="0";
        document.querySelectorAll('.compt_user_form')[0].classList.toggle('compt_user_form_animation');
        r=1;
    }else{
        document.querySelectorAll('.comp_user')[0].style.right="100%";
        document.querySelectorAll('.compt_user_form')[0].classList.remove('compt_user_form_animation');

        r=0;
    }
}
for(i=0;i<List_Memebrs.length;i++){
    ob.observe(List_Memebrs[i]);
    var d=((i*0.2)+"s").toString();
    List_Memebrs[i].style.animationDelay=d;
}

var k=0;
function show_menu_hide(){
    if(k==0){
        document.querySelectorAll('.menu_hide')[0].style.left="0";
        k=1;
    }else {
        document.querySelectorAll('.menu_hide')[0].style.left="-100%";
        k=0;
    }

}
function Quitter(){
    location.href="/";
}
function MAJ_admin(){
    var nom=document.getElementById("nom_admin").value;
    var prenom=document.getElementById("prenom_admin").value;
    var login=document.getElementById("login_admin").value;
    var pw=document.getElementById("pw_admin").value;
    if(login!="" && pw!="" && nom!="" && prenom!=""){

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
                if(this.responseText=="valide"){
                    location.href="/index";
                }else
                alert(this.responseText);
            }
        }
        xhr.open("POST","/MAJ_admin",false);
        var f=new FormData();
        f.append("nom",nom);
        f.append("prenom",prenom);
        f.append("login",login);
        f.append("pw",pw);
        if(document.getElementById("img_admin").files.length==1)
        f.append("img",document.getElementById("img_admin").files[0]);
        f.append("_token",document.getElementsByName('_token')[0].value);
        xhr.send(f);
    }else
    alert("all the fields should not be empty !!");
}
function charge_admin(){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status=200 && this.readyState==4){
            var T=JSON.parse(this.responseText);
            document.getElementById("nom_admin").value=T["nom"];
            document.getElementById("prenom_admin").value=T["prenom"];
            document.getElementById("login_admin").value=T["login"];
            document.getElementById("pw_admin").value=T["pw"];
        }
    }
    xhr.open("GET","/charger_admin",false);
    xhr.send(null);
}
function show_patient_detail(){
    if(k==0){
        document.querySelectorAll('.patient_detail')[0].style.right="0";
        document.querySelectorAll('.patient_detail_form')[0].classList.toggle('patient_detail_form_animation');
        k=1;
    }else {
        document.querySelectorAll('.patient_detail')[0].style.right="100%";
        document.querySelectorAll('.patient_detail_form')[0].classList.remove('patient_detail_form_animation');
        k=0;
    }

}

function actualiser_patient(){
   var xhr=new XMLHttpRequest();
   xhr.onreadystatechange=function(){
       if(this.status==200 && this.readyState==4){
           document.getElementById('List_patient').innerHTML=this.responseText;
           document.getElementById('nom_patient_search').value="";
document.getElementById('prenom_patient_search').value="";
document.getElementById('cni_patient_search').value="";
document.getElementById('adresse_patient_search').value="";
document.getElementById('Telephone_patient_search').value="";
document.getElementById('Date_Naissance_patient_search').value="";

       }
   }
   xhr.open("GET","get_all_patient",false);
   xhr.send();

}
function insert_update_patient(){
   var nom=document.getElementById('nom_patient').value;
    var prenom=document.getElementById('prenom_patient').value;
    var cni=document.getElementById('cni_patient').value;
    var adresse=document.getElementById('Adresse_patient').value;
    var tel=document.getElementById('Telephone_patient').value;
    var date=document.getElementById('Date_Naissance_patient').value;
    var img=document.getElementById('img_patient').files[0];
    var r_cni=RegExp('[A-Z]{1}[0-9]{7}|[A-Z]{2}[0-9]{6}');
    var r_tel=RegExp('0[0-9]{9}');
    var r_date=RegExp('((?:19|20)\\d\\d)-(0?[1-9]|1[012])-([12][0-9]|3[01]|0?[1-9])');
        if(nom!="" && prenom!=""){
      if(r_cni.test(cni)==true){
        if(r_tel.test(tel)==true){
        if(r_date.test(date)==true){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            if(this.responseText=="valide"){
                document.getElementById('insert_update_button').value="Insérer";
                actualiser_patient();
                annuler_patient();
            }
            else
            alert(this.responseText);
        }
    }
    if(document.getElementById('insert_update_button').value=="Insérer"){
        xhr.open("POST","Ajouter_patient",false);
        var f=new FormData();
        f.append("nom",nom);
        f.append("prenom",prenom);
        f.append("cni",cni);
        f.append("adresse",adresse);
        f.append("tel",tel);
        f.append("date",date);
        f.append("img",img);
        f.append("_token",document.getElementsByName('_token')[0].value);
        xhr.send(f);
    }else
    {
        xhr.open("POST","MAJ_patient",false);
        var f=new FormData();
        f.append("nom",nom);
        f.append("prenom",prenom);
        f.append("cni",cni);
        f.append("adresse",adresse);
        f.append("tel",tel);
        f.append("date",date);
        f.append("id",document.getElementById('id_patient').value);
        if(document.getElementById('img_patient').files.length==1)
        f.append("img",img);
        f.append("_token",document.getElementsByName('_token')[0].value);
        xhr.send(f);
    }

        }else
        alert("La date de naissance est incorrect !!");
        }else
        alert('Le numéro de téléphone est incorrect !!');
      }else
      alert("CNI n'est pas valide !!")
    }else
    alert("SVP tu oublier le nom au le prenom !!");
}
function show_patient_detail(id){

    if(k==0){
        document.querySelectorAll('.patient_detail')[0].style.right="0";
        document.querySelectorAll('.patient_detail_form')[0].classList.toggle('patient_detail_form_animation');
        k=1;
    }else {
        document.querySelectorAll('.patient_detail')[0].style.right="100%";
        document.querySelectorAll('.patient_detail_form')[0].classList.remove('patient_detail_form_animation');
        k=0;
    }

}
function delete_patient(id){
if(window.confirm("Voulez vous vraimment supprimer cet patient ?")==true){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status=200 && this.readyState==4){
            if(this.responseText=="valide")
            actualiser_patient();
            else
            alert(this.responseText);
        }
    }
    xhr.open("POST","delete_patient",false);
    var f=new FormData();
    f.append("id",id);
    f.append("_token",document.getElementsByName('_token')[0].value);
    xhr.send(f);
}
}
function charger_patient(id){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
             var T=JSON.parse(this.responseText);
            document.getElementById('nom_patient').value=T['nom'];
            document.getElementById('prenom_patient').value=T['prenom'];
            document.getElementById('cni_patient').value=T['cni'];
            document.getElementById('Adresse_patient').value=T['adresse'];
            document.getElementById('Telephone_patient').value=T['tel'];
            document.getElementById('Date_Naissance_patient').value=T['date_naissance'];
            document.getElementById('id_patient').value=T['id'];
            document.getElementById('insert_update_button').value="mettre à jour";
        }
    }
    xhr.open("POST","charger_patient",false);
    var f=new FormData();
    f.append("id",id);
    f.append("_token",document.getElementsByName('_token')[0].value);
    xhr.send(f);
}
function annuler_patient(){
    document.getElementById('nom_patient').value="";
    document.getElementById('prenom_patient').value="";
    document.getElementById('cni_patient').value="";
    document.getElementById('Adresse_patient').value="";
    document.getElementById('Telephone_patient').value="";
    document.getElementById('Date_Naissance_patient').value="";
    document.getElementById('id_patient').value="-1";
    document.getElementById('insert_update_button').value="Insérer";
}
function chercher_patient(){
    var nom=document.getElementById('nom_patient_search').value;
     var prenom=document.getElementById('prenom_patient_search').value;
    var cni=document.getElementById('cni_patient_search').value;
     adresse=document.getElementById('adresse_patient_search').value;
     var tel=document.getElementById('Telephone_patient_search').value;
       var date=document.getElementById('Date_Naissance_patient_search').value;
    var r_cni=RegExp('[A-Z]{1}[0-9]{7}|[A-Z]{2}[0-9]{6}');
    var r_tel=RegExp('0[0-9]{9}');
    var r_date=RegExp('((?:19|20)\\d\\d)-(0?[1-9]|1[012])-([12][0-9]|3[01]|0?[1-9])');
      if(r_cni.test(cni)==true || cni==""){
        if(r_tel.test(tel)==true || tel==""){
        if(r_date.test(date)==true || date==""){
            var xhr=new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if(this.status==200 && this.readyState==4){
                document.getElementById('List_patient').innerHTML=this.responseText;
                }
            }
            xhr.open("POST","chercher_patient",false);
            var f=new FormData();
            f.append("nom",nom);
            f.append("prenom",prenom);
            f.append("cni",cni);
            f.append("adresse",adresse);
            f.append("tel",tel);
            f.append("_token",document.getElementsByName('_token')[0].value);
            f.append("date",date);
            xhr.send(f);
        }else
        alert("La date de naissance est incorrect !!");
        }else
        alert('Le numéro de téléphone est incorrect !!');
      }else
      alert("CNI n'est pas valide !!")

}
function detail_patient(id){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            var T=JSON.parse(this.responseText);
            document.getElementById('nom_complet_patient_detail').innerHTML=T['nom']+" "+T['prenom'];
            document.getElementById('cni_patient_detail').innerHTML=T['cni'];
            document.getElementById('adresse_patient_detail').innerHTML=T['adresse'];
            document.getElementById('tel_patient_detail').innerHTML=T['tel'];
            document.getElementById('date_patient_detail').innerHTML=T['date_naissance'];
            document.getElementById('img_patient_detail').src=T['path_image'];
        }
    }
    xhr.open("POST","detail_patient",false);
    var f=new FormData();
    f.append("id",id);
    f.append("_token",document.getElementsByName('_token')[0].value);
xhr.send(f);
 //
//

//
//
//
//
//alert(document.getElementById('nom_complet_patient_detail').innerHTML)
}
function insert_update_RDV(){
    //
// Patient_RDV_by
// date_RDV
// heure_RDV
// status_RDV
  var patient_value=document.getElementById('patient_RDV_value').value;
  var patient_by=document.getElementById('Patient_RDV_by').value;
  var date=document.getElementById('date_RDV').value;
  var heure=document.getElementById('heure_RDV').value;
  var status=document.getElementById('status_RDV').value;
      var r_tel=RegExp('0[0-9]{9}');

 var r_cni=RegExp('[A-Z]{1}[0-9]{7}|[A-Z]{2}[0-9]{6}');
 var r_time=RegExp('([0-2][0-3]):([0-5][0-9])');
 var r_date=RegExp('((?:19|20)\\d\\d)-(0?[1-9]|1[012])-([12][0-9]|3[01]|0?[1-9])');
 var r_tel=RegExp('0[0-9]{9}');
 var xhr=new XMLHttpRequest();
 xhr.onreadystatechange=function(){
     if(this.status==200 && this.readyState==4){
      if(this.responseText=="valide"){
        annuler_RDV();
      }else
      alert(this.responseText);

         }
 }
 if(document.getElementById('insert_update_button_rdv').value=="Mettre à jour"){
    xhr.open("POST","MAJ_RDV",true);
 }else
 xhr.open("POST","insert_RDV",true);
 var f=new FormData();
 f.append("id_rdv",document.getElementById('id_rdv').value);
 f.append("patient_value",patient_value);
 f.append("patient_by",patient_by);
 f.append("date",date);
 f.append("heure",heure);
 f.append("status",status);
 f.append("_token",document.getElementsByName('_token')[0].value);
 xhr.send(f);
// if((r_cni.test(patient_value)==true && patient_by=="CNI") || (r_tel.test(patient_value)==true && patient_by=="Tel") || (patient_by=="Nom & prenom" && patient_value!="")){
//     // if(r_time.test(heure)==true){
//     //   if(r_date.test(date)==true){

//     //   }
//     //   alert("SVP la date est invalide !!");
//     // }
//     // alert("le temps est invalide !!");
//     alert("valide requeste");
// }else
// alert("Choix invalide pour le patient !!");

}
function annuler_RDV(){
        document.getElementById('patient_RDV_value').value="";
        document.getElementById('Patient_RDV_by').value="CNI";
        document.getElementById('date_RDV').value="";
        document.getElementById('heure_RDV').value="";
        document.getElementById('status_RDV').value="Status";
        document.getElementById('patient_RDV_value_chercher').value="";
        document.getElementById('Patient_RDV_by_chercher').value="CNI";
        document.getElementById('date_RDV_chercher').value="";
        document.getElementById('heure_RDV_chercher').value="";
        document.getElementById('status_RDV_chercher').value="Status";
        document.getElementById('insert_update_button_rdv').value="Insérer";
        document.getElementById('patient_RDV_value').removeAttribute("readonly");
        document.getElementById('Patient_RDV_by').removeAttribute("disabled");
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4)
        document.querySelectorAll('.List_RDV')[0].innerHTML=this.responseText;
    }
    xhr.open("GET","get_all_rdv",true);
    xhr.send();
}
function delete_rdv(id,id_admin,id_patient){
   if(window.confirm("Voulez vous vraimment supprimer cette Rendez vous ?")==true){

       var xhr=new XMLHttpRequest();
       xhr.onreadystatechange=function(){
           if(this.status==200 && this.readyState==4)
           if(this.responseText=="valide"){
               annuler_RDV();
            }else
            alert(this.responseText);
        }
        xhr.open("POST","delete_rdv",false);
        var f=new FormData();
        f.append("id",id);
        f.append("id_admin",id_admin);
        f.append("_token",document.getElementsByName('_token')[0].value);
        f.append("id_patient",id_patient);
        xhr.send(f);
    }
}
function charger_rdv(id,id_admin,id_patient){
  var xhr=new XMLHttpRequest();
  xhr.onreadystatechange=function(){
      if(this.status==200 && this.readyState==4){
          var T=JSON.parse(this.responseText);
        document.getElementById('patient_RDV_value').value=T['cni'];
        document.getElementById('Patient_RDV_by').value="CNI";
        document.getElementById('date_RDV').value=T['date'];
        document.getElementById('heure_RDV').value=T['heure'];
        document.getElementById('status_RDV').value=T['status'];
        document.getElementById('insert_update_button_rdv').value="Mettre à jour";
        document.getElementById('patient_RDV_value').setAttribute("readonly", true);
        document.getElementById('Patient_RDV_by').setAttribute("disabled", true);
        document.getElementById('id_rdv').value=T['id'];
  }}
  xhr.open("POST","charger_rdv",true);
  var f=new FormData();
  f.append("id",id);
  f.append("id_admin",id_admin);
  f.append("_token",document.getElementsByName('_token')[0].value);
  f.append("id_patient",id_patient);
  xhr.send(f);
}
function chercher_rdv(){
    var patient_value=document.getElementById('patient_RDV_value_chercher').value;
    var patient_by=document.getElementById('Patient_RDV_by_chercher').value;
    var date=document.getElementById('date_RDV_chercher').value;
    var heure=document.getElementById('heure_RDV_chercher').value;
    var status=document.getElementById('status_RDV_chercher').value;
      var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            document.querySelectorAll('.List_RDV')[0].innerHTML=this.responseText;
        }
    }
    xhr.open("POST","chercher_rdv",true);
    var f=new FormData();
    f.append("id_rdv",document.getElementById('id_rdv').value);
    f.append("patient_value",patient_value);
    f.append("patient_by",patient_by);
    f.append("date",date);
    f.append("heure",heure);
    f.append("status",status);
    f.append("_token",document.getElementsByName('_token')[0].value);
    xhr.send(f);
}
function insert_update_visite(){
var patient_value=document.getElementById('patient_visite_value').value;
var patient_by=document.getElementById('Patient_visite_by').value;
var debut=document.getElementById('debut_visite').value;
var fin=document.getElementById('fin_visite').value;
var prix=document.getElementById('prix_visite').value;
var date=document.getElementById('date_visite').value;
var desc=document.getElementById('desc_visite').value;
var r_cni=RegExp('[A-Z]{1}[0-9]{7}|[A-Z]{2}[0-9]{6}');
var r_date=RegExp('((?:19|20)\\d\\d)-(0?[1-9]|1[012])-([12][0-9]|3[01]|0?[1-9])');
var r_tel=RegExp('0[0-9]{9}');

if((r_cni.test(patient_value)==true && patient_by=="CNI") || (r_tel.test(patient_value)==true && patient_by=="Tel") || (patient_by=="Nom & prenom" && patient_value!=""))
{
 if(debut && fin && date && prix && desc){
    if(debut<fin){
        if(isFinite(prix)==true){
            if(r_date.test(date)==true){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            if(this.responseText=="valide")
            annuler_visite();
            else
            alert(this.responseText);
        }
    }
    if(document.getElementById('insert_update_button_visite').value=="Mettre à jour")
    xhr.open("POST","update_visite",true);
    else
    xhr.open("POST","insert_visite",true);
    var f=new FormData();
    f.append("patient_value",patient_value);
    f.append("patient_by",patient_by);
    f.append("id",document.getElementById('id_visite').value);
    f.append("debut",debut);
    f.append("fin",fin);
    f.append("prix",prix);
    f.append("date",date);
    f.append("desc",desc);
    f.append("_token",document.getElementsByName('_token')[0].value);
    xhr.send(f);
            }else
            alert("SVP le format de date est incorrect !!");
        }else
        alert("SVP le pix doit être un chiffre !!");
    }
    else
    alert("SVP le temps de début doit être inférieure à le temps de fin !!");
}else

alert("SVP tout les champs sont obligatiore !!");
}else
alert("Le patient est obligatoire !!")

//alert(patient_value+patient_by+debut+fin+prix+date+desc);

}
function annuler_visite(){
document.getElementById('patient_visite_value_chercher').value="";
document.getElementById('Patient_visite_by_chercher').value="CNI";
document.getElementById('debut_visite_chercher').value="";
document.getElementById('fin_visite_chercher').value="";
document.getElementById('prix_visite_chercher').value="";
document.getElementById('date_visite_chercher').value="";
document.getElementById('patient_visite_value').value="";
document.getElementById('Patient_visite_by').value="CNI";
document.getElementById('debut_visite').value="";
document.getElementById('fin_visite').value="";
document.getElementById('prix_visite').value="";
document.getElementById('date_visite').value="";
document.getElementById('desc_visite').value="";
document.getElementById('patient_visite_value').removeAttribute('readonly');
document.getElementById('Patient_visite_by').removeAttribute('disabled');
document.getElementById('insert_update_button_visite').value="Insérer";
var xhr=new XMLHttpRequest();
xhr.onreadystatechange=function(){
    if(this.status==200 && this.readyState==4){
      document.getElementById('List_visite').innerHTML=this.responseText;
    }
}
xhr.open("GET","get_all_visits",false);
xhr.send();
}
function delete_visite(id){
 if(window.confirm("Voulez vous vraiment supprimet cet visite ?")==true){
     var xhr=new XMLHttpRequest();
     xhr.onreadystatechange=function(){
         if(this.status==200 && this.readyState==4){
             if(this.responseText=="valide")
             annuler_visite();
             else
             alert(this.responseText);

         }
     }
     xhr.open("POST","delete_visite",true);
     var f=new FormData();
     f.append("id",id);
     f.append("_token",document.getElementsByName('_token')[0].value);
     xhr.send(f);
 }
}
function charger_visite(id){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            var T=JSON.parse(this.responseText);

            document.getElementById('patient_visite_value').value=T['cni'];
            document.getElementById('Patient_visite_by').value='CNI';
            document.getElementById('debut_visite').value=T['debut'];
            document.getElementById('fin_visite').value=T['fin'];
            document.getElementById('prix_visite').value=T['prix'];
            document.getElementById('date_visite').value=T['date'];
            document.getElementById('desc_visite').value=T['desc'];
            document.getElementById('id_visite').value=T['id'];
            document.getElementById('patient_visite_value').setAttribute('readonly',true);
            document.getElementById('Patient_visite_by').setAttribute('disabled',true);
            document.getElementById('insert_update_button_visite').value="Mettre à jour";


            // if(this.responseText=="valide")
            // annuler_visite();
            // else
            // alert(this.responseText);

        }
    }
    xhr.open("POST","charger_visite",true);
    var f=new FormData();
    f.append("id",id);
    f.append("_token",document.getElementsByName('_token')[0].value);
    xhr.send(f);

}
function show_visite_detail(){
           document.querySelectorAll('.visite_detail')[0].style.right="100%";
        k=0;

}
function detail_visite(id){
var xhr=new XMLHttpRequest();
xhr.onreadystatechange=function(){
    if(this.status==200 && this.readyState==4){
        var T=JSON.parse(this.responseText);
        document.getElementById('img_patient_detail_visite').src=T['path_image'];
        document.getElementById('nom_complet_patient_detail_visite').innerHTML=T['nom']+" "+T['prenom'];
        document.getElementById('cni_patient_detail_visite').innerHTML=T['cni'];
        document.getElementById('adresse_patient_detail_visite').innerHTML=T['adresse'];
        document.getElementById('tel_patient_detail_visite').innerHTML=T['tel'];
        document.getElementById('date_patient_detail_visite').innerHTML=T['date_naissance'];
        document.getElementById('date_visite_detail').innerHTML=T['date'];
        document.getElementById('debut_visite_detail').innerHTML=T['debut'];
        document.getElementById('fin_visite_detail').innerHTML=T['fin'];
        document.getElementById('prix_visite_detail').innerHTML=T['prix'];
        document.getElementById('desc_visite_detail').innerHTML=T['desc'];
        if(k==0){
            document.querySelectorAll('.visite_detail')[0].style.right="0";
          //  document.querySelectorAll('.patient_detail_form')[0].classList.toggle('patient_detail_form_animation');
            k=1;
        }else {
            document.querySelectorAll('.visite_detail')[0].style.right="100%";
        //    document.querySelectorAll('.patient_detail_form')[0].classList.remove('patient_detail_form_animation');
            k=0;
        }

    }
}
xhr.open("POST","detail_visite",true);
var f=new FormData();
f.append("id",id);
f.append("_token",document.getElementsByName('_token')[0].value);
xhr.send(f);
}

function chercher_visite(){
// patient_visite_value_chercher
// Patient_visite_by_chercher
// date_visite_chercher
// debut_visite_chercher
// fin_visite_chercher
// prix_visite_chercher
var patient_value=document.getElementById('patient_visite_value_chercher').value;
var patient_by=document.getElementById('Patient_visite_by_chercher').value;
var debut=document.getElementById('debut_visite_chercher').value;
var fin=document.getElementById('fin_visite_chercher').value;
var prix=document.getElementById('prix_visite_chercher').value;
var date=document.getElementById('date_visite_chercher').value;
var xhr=new XMLHttpRequest();
xhr.onreadystatechange=function(){
    if(this.status==200 && this.readyState==4){
        document.getElementById('List_visite').innerHTML=this.responseText;
    }
}
xhr.open("POST","search_visite",true);
var f=new FormData();
f.append("patient_value",patient_value);
f.append("patient_by",patient_by);
f.append("date",date);
f.append("debut",debut);
f.append("fin",fin);
f.append("prix",prix);
f.append("_token",document.getElementsByName('_token')[0].value);
xhr.send(f);
}
function insert_update_medicament(){
        var code=document.getElementById('code_Medicament').value;
        var desi=document.getElementById('des_Medicament').value;
        var format=document.getElementById('format_Medicament').value;
        var date_exp=document.getElementById('date_exp_Medicament').value;
        var SA=document.getElementById('SA_Medicament').value;
        var SM=document.getElementById('SM_Medicament').value;
        var prix=document.getElementById('prix_Medicament').value;

    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status=200 && this.readyState==4){
   if(this.responseText=="valide")
   annuler_medicament();
   else
   alert(this.responseText);

        }
    }
    if(document.getElementById('insert_update_button_medicament').value=="Insérer")
    xhr.open("POST","insert_medicament",true);
    else
    xhr.open("POST","update_medicament",true);
    var f=new FormData();
    f.append("_token",document.getElementsByName('_token')[0].value);
    f.append("code",code);
    f.append("desi",desi);
    f.append("format",format);
    f.append('id',document.getElementById('id_medicament').value);
    f.append("date_exp",date_exp);
    f.append("SA",SA);
    f.append("SM",SM);
    f.append("prix",prix);
    xhr.send(f);
}
function annuler_medicament(){
    document.getElementById('code_Medicament').value="";
    document.getElementById('des_Medicament').value="";
    document.getElementById('format_Medicament').value="";
    document.getElementById('date_exp_Medicament').value="";
    document.getElementById('SA_Medicament').value="";
    document.getElementById('SM_Medicament').value="";
    document.getElementById('prix_Medicament').value="";
    document.getElementById('insert_update_button_medicament').value="Insérer";
    document.getElementById('id_medicament').value=-1;
        document.getElementById("code_medicament_chercher").value="";
        document.getElementById("Designation_medicament_chercher").value=""; 
        document.getElementById("format_medicament_chercher").value="";
        document.getElementById("date_medicament_chercher").value="";
        document.getElementById("SA_chercher_medicament_chercher").value="";
        document.getElementById("SM_medicament_chercherr").value="";
        document.getElementById("prix_chercher_medicament_chercher").value="";
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            document.getElementById('List_medicament').innerHTML=this.responseText;
        }
    }
    xhr.open("GET","get_all_medicament",false);
    xhr.send();
}
// detail_medicament
// update_medicament
// delete_medicament
function show_medicament_detail(){
    document.querySelectorAll('.medicament_detail')[0].style.right="100%";
    //  document.querySelectorAll('.patient_detail_form')[0].classList.toggle('patient_detail_form_animation');
      k=0;
}
function detail_medicament(id){
// alert(id);
if(k==0){
    document.querySelectorAll('.medicament_detail')[0].style.right="0";
  //  document.querySelectorAll('.patient_detail_form')[0].classList.toggle('patient_detail_form_animation');
    k=1;
}else {
    document.querySelectorAll('.medicament_detail')[0].style.right="100%";
//    document.querySelectorAll('.patient_detail_form')[0].classList.remove('patient_detail_form_animation');
    k=0;
}
var xhr=new XMLHttpRequest();
xhr.onreadystatechange=function(){
    if(this.status==200 && this.readyState==4){
        // if(this.responseText=="valide")
        // annuler_medicament();
        // else
        alert(this.responseText);
    }
}
xhr.open("POST","detail_medicament",true);
var f=new FormData();
f.append("id",id);
f.append("_token",document.getElementsByName('_token')[0].value);
xhr.send(f);
// document.getElementById('detail_medicament_code').value=T[''];
// document.getElementById('detail_medicament_desi').value=T[''];
// document.getElementById('detail_medicament_format').value=T[''];
// document.getElementById('detail_medicament_date').value=T[''];
// document.getElementById('detail_medicament_SA').value=T[''];
// document.getElementById('detail_medicament_SM').value=T[''];
// document.getElementById('detail_medicament_prix').value=T[''];
}

function update_medicament(id){
    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            var T=JSON.parse(this.responseText);
            document.getElementById('code_Medicament').value=T['code_medicament'];
            document.getElementById('des_Medicament').value=T['desi'];
            document.getElementById('format_Medicament').value=T['format'];
            document.getElementById('date_exp_Medicament').value=T['date_expiration'];
            document.getElementById('SA_Medicament').value=T['Stock_Min'];
            document.getElementById('SM_Medicament').value=T['Stock_actuel'];
            document.getElementById('prix_Medicament').value=T['prix'];
            document.getElementById('id_medicament').value=T['id'];
            document.getElementById('insert_update_button_medicament').value="Mettre à jour";

              }
    }
    xhr.open("POST","charger_medicament",true);
    var f=new FormData();
    f.append("id",id);
    f.append("_token",document.getElementsByName('_token')[0].value);
    xhr.send(f);
    }

function delete_medicament(id){
    if(window.confirm("Voulez vous vraiment Supprimer cet medicamment !!")==true){

        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
                if(this.responseText=="valide")
                annuler_medicament();
                else
                alert(this.responseText);
            }
        }
        xhr.open("POST","delete_medicament",true);
        var f=new FormData();
        f.append("id",id);
        f.append("_token",document.getElementsByName('_token')[0].value);
        xhr.send(f);
    }
    }
    function chercher_medicament(){
            var code="%"+document.getElementById("code_medicament_chercher").value+"%";
            var desi="%"+document.getElementById("Designation_medicament_chercher").value+"%";
            var format="%"+document.getElementById("format_medicament_chercher").value+"%";
            var date="%"+document.getElementById("date_medicament_chercher").value+"%";
            var SA="%"+document.getElementById("SA_chercher_medicament_chercher").value+"%";
            var SM="%"+document.getElementById("SM_medicament_chercherr").value+"%";
            var prix="%"+document.getElementById("prix_chercher_medicament_chercher").value+"%";
            var xhr=new XMLHttpRequest();
            xhr.onreadystatechange=function(){
                if(this.status==200 && this.readyState==4){
                    document.getElementById('List_medicament').innerHTML=this.responseText;
                }
            }
            xhr.open("POST","chercher_medicament",true);
            var f=new FormData();
            f.append("code",code);
            f.append("desi",desi);
            f.append("format",format);
            f.append("date",date);
            f.append("prix",prix);
            f.append("SM",SM);
            f.append("SA",SA);
            f.append("_token",document.getElementsByName('_token')[0].value);
            xhr.send(f);
    }
    function actualiser_medicament_ordonnance(){
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
                document.getElementById('list_ordonnance_medicament_exist').innerHTML=this.responseText;
            }
        }
        xhr.open("GET","get_medicament_ordonnance",true);
        xhr.send();
    }
    var Panier=new Array();
    var T_Panier=new Array();
    function AddToPanier(id,code,desi,format){
        var r="";
      for(i=0;i<Panier.length;i++){
          if(id==Panier[i][0]){
              r="SVP ce medicament exist deja dans cet ordonnance !";
              break;
          }
        }
        if(r==""){
            Panier.push([id,code,desi,format]);
            T_Panier.push(id);
            var item="";
            for(i=0;i<Panier.length;i++){
            item+="<div class='red_on' onclick='deletefromPanier("+i+")'>" 
            item+="<span class='ticket_MO'>Code :</span><span class='value_MO' id='codeMedicament_ordonnance'>"+Panier[i][1]+"</span><br>"
            item+="<span class='ticket_MO'>Designation :</span><span class='value_MO' id='codeMedicament_ordonnance'>"+Panier[i][2]+"</span><br>"
            item+="<span class='ticket_MO'>Format :</span><span class='value_MO' id='codeMedicament_ordonnance'>"+Panier[i][3]+"</span>"
            item+="</div>";
        }
        document.getElementById('list_ordonnance_medicament_paniet').innerHTML=item;
        }
      else
      alert(r);
    }
    function deletefromPanier(indic){
        if(window.confirm("allez-vous vraiment supprimer ce médicament du Panier ?")==true){

            Panier.splice(indic,1);
            T_Panier.splice(indic,1);
            var item="";
            for(i=0;i<Panier.length;i++){
                item+="<div class='red_on' onclick='deletefromPanier("+i+")'>" 
                item+="<span class='ticket_MO'>Code :</span><span class='value_MO' id='codeMedicament_ordonnance'>"+Panier[i][1]+"</span><br>"
                item+="<span class='ticket_MO'>Designation :</span><span class='value_MO' id='codeMedicament_ordonnance'>"+Panier[i][2]+"</span><br>"
                item+="<span class='ticket_MO'>Format :</span><span class='value_MO' id='codeMedicament_ordonnance'>"+Panier[i][3]+"</span>"
                item+="</div>";
            }
            document.getElementById('list_ordonnance_medicament_paniet').innerHTML=item;
        }

    }
    function ViderPanier(){
        if(window.confirm("Voulez vous vraiment Vider le Panier ?")==true){
Panier=new Array();
T_Panier=new Array();
            document.getElementById('list_ordonnance_medicament_paniet').innerHTML="";
        }
    }
    function chercher_medicament_ordonnance(){
        var m_by=document.getElementById('Medicament_ordonnance_by').value;
        var m_value="%"+document.getElementById('Medicament_ordonnance_value').value+"%";
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){

                // alert(this.responseText);
                document.getElementById('list_ordonnance_medicament_exist').innerHTML=this.responseText;

            }
        }
        xhr.open("POST","get_medicament",true);
        var f=new FormData();
        f.append("m_by",m_by);
        f.append("m_value",m_value);
        f.append("_token",document.getElementsByName('_token')[0].value);
        xhr.send(f);
    }
    function annuler_ordonnance(){
        document.getElementById('patient_ordonnance_value').value="";
        document.getElementById('Patient_ordonnance_by').value="CNI";
        document.getElementById('date_ordonnance').value="";
        document.getElementById('Medicament_ordonnance_by').value="code_medicament";
        document.getElementById('Medicament_ordonnance_value').value="";
        Panier=new Array();
        T_Panier=new Array();
        document.getElementById('list_ordonnance_medicament_paniet').innerHTML="";
        document.getElementById('patient_ordonnance_value').removeAttribute("readonly");
        document.getElementById('Patient_ordonnance_by').removeAttribute("disabled");
        document.getElementById('insert_update_button_ordonnance').value="Insérer";
        actualiser_medicament_ordonnance();
        actualiser_ordonnance();  
        document.getElementById('id_ordonnance').value=-1; 
    }
    function insert_update_ordonnance(){
        var p_value=document.getElementById('patient_ordonnance_value').value;
        var p_by=document.getElementById('Patient_ordonnance_by').value;
        var date_ordonnance=document.getElementById('date_ordonnance').value;
        var r_date=RegExp('((?:19|20)\\d\\d)-(0?[1-9]|1[012])-([12][0-9]|3[01]|0?[1-9])');
        if(Panier.length!=0){
        if(p_value!=""){
            if(r_date.test(date_ordonnance)==true){

                var xhr=new XMLHttpRequest();
         xhr.onreadystatechange=function(){
             if(this.status==200 && this.readyState==4){
               if(this.responseText=="valide"){
                annuler_ordonnance();
               }else
               alert(this.responseText);
             }
         }
         if(document.getElementById('insert_update_button_ordonnance').value!="mettre à jour")
         xhr.open("POST","add_ordonnance",true);
         else{
         xhr.open("POST","update_ordonnance",true);
         }
         var f=new FormData();
         f.append("id",document.getElementById('id_ordonnance').value);
         f.append("p_value",p_value);
         f.append("date_ordonnance",date_ordonnance);
         f.append("Panier",T_Panier);
         f.append("p_by",p_by);
         f.append("_token",document.getElementsByName('_token')[0].value);
         xhr.send(f);
        }else
        alert("SVP format de date est invalide !!");
        }else 
        alert("SVP nous avons besoin le patient concerné au cet ordonnance !!");
        }else{
            alert("SVP ajouter au moins un seule medicament au Panier !!");
        }
    }
    function actualiser_ordonnance(){
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
//                alert(this.responseText);
                document.getElementById('List_ordonnance').innerHTML=this.responseText;
            }
        }
      xhr.open("GET","get_ordonnance",true);
      xhr.send();
    }
    function delete_ordonnance(id){
        if(window.confirm("Voulez vous vraiment supprimer cet ordonnance ?")==true){

            var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
                if(this.responseText=="valide"){
                    actualiser_ordonnance();
                }else
                alert(this.responseText);
            }
        }
        xhr.open("POST","delete_ordonnance",true);
        var f=new FormData();
        f.append("id",id);
        f.append("_token",document.getElementsByName('_token')[0].value);
        xhr.send(f);
    }
}
    function charger_ordonnance(id){
        var xhr=new XMLHttpRequest();
        xhr.onreadystatechange=function(){
            if(this.status==200 && this.readyState==4){
                var T=JSON.parse(this.responseText);
                var item="";
                for(i=0;i<T["medicament"].length;i++){
                    item+="<div class='red_on' onclick='deletefromPanier("+i+")'>" 
                    item+="<span class='ticket_MO'>Code :</span><span class='value_MO' id='codeMedicament_ordonnance'>"+T["medicament"][i].code_medicament+"</span><br>"
                    item+="<span class='ticket_MO'>Designation :</span><span class='value_MO' id='codeMedicament_ordonnance'>"+T["medicament"][i].desi+"</span><br>"
                    item+="<span class='ticket_MO'>Format :</span><span class='value_MO' id='codeMedicament_ordonnance'>"+T["medicament"][i].format+"</span>"
                    item+="</div>";
                    T_Panier.push(T["medicament"][i].id);
                    Panier.push([T["medicament"][i].id,T["medicament"][i].code_medicament,T["medicament"][i].desi,T["medicament"][i].format]);
                }
                document.getElementById('list_ordonnance_medicament_paniet').innerHTML=item;
                document.getElementById('patient_ordonnance_value').value=T["ordonnance"][0].cni;
                document.getElementById('Patient_ordonnance_by').value="CNI";
                document.getElementById('date_ordonnance').value=T["ordonnance"][0].date;
                document.getElementById('id_ordonnance').value=T["ordonnance"][0].id;
                document.getElementById('patient_ordonnance_value').setAttribute("readonly", true);
                document.getElementById('Patient_ordonnance_by').setAttribute("disabled", true);
        document.getElementById('insert_update_button_ordonnance').value="mettre à jour";       
            }
        }
        xhr.open("POST","charger_ordonnance",true);
        var f=new FormData();
        f.append("id",id);
        f.append("_token",document.getElementsByName('_token')[0].value);
        xhr.send(f);
    }