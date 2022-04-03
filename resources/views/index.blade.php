<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href="{{asset('assets/css/style_index.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Nunito&display=swap" rel="stylesheet">
</head>
<body onload="charge_admin();actualiser_patient();annuler_RDV();annuler_visite();annuler_medicament();actualiser_medicament_ordonnance();actualiser_ordonnance();">
    <!-- Menu navbare -->
    @csrf
    <header>
        <nav class="menu_nav_normal">
            <ul class="List_items_navbar">
                <img src="{{url($path)}}" class="compt_image">
                <li class="item_navbar_member nom_compt" onclick="compt_user();" >{{$nom.' '.$prenom}}</li>
          <li class="item_navbar_member"> <a href="#patients">Gestion des patients</a></li>
                <li class="item_navbar_member"><a href="#visites">Gestion des visites</a></li>
                <li class="item_navbar_member">Gestion des médicaments</li>
                <li class="item_navbar_member">Gestion des ordonnances</li>
                <li class="item_navbar_member">Statistique</li>
                <li class="item_navbar_member" onclick="compt_user();">Compt</li>
                <li class="item_navbar_member" onclick="Quitter();">Quitter</li>
                <li class="item_navbar_member_icon"><ion-icon onclick="show_menu_hide();" class="icon_menu" name="menu-outline"></ion-icon></li>
            </ul>
        </nav>    
    </header>
    <!--end Menu navbare  -->
    <!-- section menu hide -->
    <section  class="menu_hide">
    <center>
        <ul class="List_items_navbar_hide">


            <a href="#patients"><li onclick="show_menu_hide();" class="item_navbar_member_hide">Gestion des patients</li></a>

            <a href="#visites"><li onclick="show_menu_hide();" class="item_navbar_member_hide">Gestion des visites</li></a>
            <li onclick="show_menu_hide();" class="item_navbar_member_hide">Gestion des médicaments</li>
            <li onclick="show_menu_hide();" class="item_navbar_member_hide">Gestion des ordonnances</li>
            <li onclick="show_menu_hide();" class="item_navbar_member_hide">Statistique</li>
            <li onclick="show_menu_hide();compt_user();" class="item_navbar_member_hide">Compt</li>
            <li onclick="show_menu_hide();Quitter();" class="item_navbar_member_hide">Quitter</li>
        </ul>
    </center>
    </section>
    <!-- end section menu hide  -->
    <!-- section compt -->
      <section class="comp_user" >
          <center>
              <div class="compt_user_form">
                  <center>
                      <br>
                      <h1 class="title">Votre Profile</h1>
                      <br>
                      <div class="container_inputs">
                          <div class="input_item"><input type="file" accept="image/*" id="img_admin" class="input_text"></div><br>
                    </div>
                      <div class="container_inputs">
                          <div class="input_item"><input type="text"  value="{{$nom}}" placeholder="Nom" id="nom_admin"  class="input_text"></div><br>
                          <div class="input_item"><input type="text"  value="{{$prenom}}" placeholder="Prenom" id="prenom_admin" class="input_text"></div>
                      </div>
                      <br>
                      <div class="container_inputs">
                          <div class="input_item"><input type="text" value="{{$login}}" placeholder="Login" id="login_admin" class="input_text"></div><br>
                          <div class="input_item"><input type="text" value="{{$pw}}" placeholder="Mot de passe" id="pw_admin" class="input_text"></div>
                      </div>
                      <br>
                      <input type="button" value="Mettre à jour le profil" onclick="MAJ_admin();" class="inputs_btn">
                      <input type="button" onclick="compt_user();" value="Annuler" class="inputs_btn">
                  </center>
              </div>
          </center>
      </section>
    <!-- end secyion compt  -->

    <!-- section Patient detail -->
    <section class="patient_detail">
        <center>
            <div class="patient_detail_form">
                <br>
              <h1 class="title">Detail Patient</h1>
              <br>
              <div class="box_detail_patient">
        <div class="box_detail_patient_item">     
        <img src="images/login1.png" id="img_patient_detail" alt="" class="img_detail_patient">
        <br>
        <p id="nom_complet_patient_detail">Nassim Eloualydy</p>
        </div>
        <div class="box_detail_patient_item">
        <center>
        <table id="detai_table_patient">
        <tr>
          <th>Cni</th>
          <td id="cni_patient_detail">CD704354</td>
        </tr>
        <tr>
          <th>Adresse</th>
          <td id="adresse_patient_detail">AV ORAN LIBREVILLE FES ZOUHORE 1</td>
        </tr>
        <tr>
          <th>Date</th>
          <td id="date_patient_detail">2000-10-20</td>
        </tr>
        <tr>
          <th>Tel</th>
          <td id="tel_patient_detail">0661321561</td>
        </tr>
        </table>
        
        </center>
        </div>
              </div>
              <br>
              <div class="box_detail_patient_visits">
                  <div class="box_detail_patient_item_visits">
                      <center>
                          <br>
                          <img src="{{asset('assets/css/images/visits.png')}}" alt="" class="img_detail_patient">                            
                          <br>
                          <h4>Nombre de visite : 70</h4>
                          <br>
        
                      </center>
                  </div>
                  <div class="box_detail_patient_item_visits">
                      <center>
                          <br>
                          <img src="{{asset('assets/css/images/medicament.png')}}" alt="" class="img_detail_patient">                            
                          <br>
                          <h4>Nombre de medicament : 70</h4>
                          <br>
        
                      </center>
                  </div>
                  <div class="box_detail_patient_item_visits">
                      <center>
                          <br>
                          <img src="{{asset('assets/css/images/ordonnance.png')}}" alt="" class="img_detail_patient">                            
                          <br>
                          <h4>Nombre de ordonnance : 70</h4>
                          <br>
        <br>
        
                      </center>
                  </div>
        
              </div>
              <br>
              <input type="button" value="Fermer" onclick="show_patient_detail();" class="inputs_btn">
<br>  
            </div>

        </center>
    </section>
    <!-- end Patient detail-->
    <section class="visite_detail">
        <center>
            <div class="visite_detail_form">
     <br>
     <h1 class="title">Detail Visite</h1>
    <br>
    <div class="box_detail_patient">
        <div class="box_detail_patient_item">     
        <img src="images/login1.png" id="img_patient_detail_visite" alt="" class="img_detail_patient">
        <br>
        <p id="nom_complet_patient_detail_visite">Nassim Eloualydy</p>
        </div>
        <div class="box_detail_patient_item">
        <center>
        <table id="detai_table_patient">
        <tr>
          <th>Cni</th>
          <td id="cni_patient_detail_visite">CD704354</td>
        </tr>
        <tr>
          <th>Adresse</th>
          <td id="adresse_patient_detail_visite">AV ORAN LIBREVILLE FES ZOUHORE 1</td>
        </tr>
        <tr>
          <th>Date</th>
          <td id="date_patient_detail_visite">2000-10-20</td>
        </tr>
        <tr>
          <th>Tel</th>
          <td id="tel_patient_detail_visite">0661321561</td>
        </tr>
        </table>
        
        </center>
        </div>
              </div>
<br>
<div class="box_detail_patient box_vivist_patient">
    <table class="table_visite_detail">
     <tr>
        <th >Date :</th><td id="date_visite_detail">2000-10-20</td><th>Debut :</th><td id="debut_visite_detail">10:10</td><th>Fin :</th><td id="fin_visite_detail">12:10</td>
     </tr>
     <tr>
        <th>Prix :</th><td id="prix_visite_detail">500 </td><th>Description :</th><td colspan="3" id="desc_visite_detail">Verfication generale</td>
     </tr>
     
    </table>
</div>
<br>               <input type="button" value="Fermer" onclick="show_visite_detail();" class="inputs_btn">
<br>
            </div>
        </center>
    </section>
    <!-- section Patient  -->
    <!-- section medicament  -->
    <section class="medicament_detail">
        <center>
            <div class="visite_detail_form">
                <br>
                <h1 class="title">Detail Medicament</h1>
                <br>
                <table class="table_visite_detail">
                    <tr>
                        <th>Code :</th><td id="detail_medicament_code">CD704354</td><th>Designation :</th><td id="detail_medicament_desi">Doliprane</td>
                    </tr>
                    <tr>
                        <th>Format :</th><td id="detail_medicament_format">CD704354</td><th>Date Expiration :</th><td id="detail_medicament_date">2000-10-20</td>
                    </tr>
                    <tr>
                        <th>Stock Actuel :</th><td id="detail_medicament_SA">400</td><th>Stock Minimale :</th><td id="detail_medicament_SM">2000-10-20</td>
                    </tr>
                    <tr>
                        <th>Prix :</th><td id="detail_medicament_prix">400</td>
                    </tr>
                   
                </table>
 <br>               <input type="button" value="Fermer" onclick="show_medicament_detail();" class="inputs_btn">

            </div>
        </center>
    </section>
    </div>
    <!-- section medicament  -->
    <div id="patients"></div>
 <section  class="section section_f">
     <center>
         <br>
        <h1>Gestion patients</h1>
        
     <div  class="contaier_boxes">
        <div class="box_item">
            <center>
                <br>
                <h3 class="title">Liste des Patient</h3>
               <br>
               <div class="container_inputs_search">
                <div class="input_item_search"><input type="text"  placeholder="Nom" id="nom_patient_search"  class="input_text"></div><br>
                <div class="input_item_search"><input type="text"  placeholder="Prenom" id="prenom_patient_search" class="input_text"></div>
                <div class="input_item_search"><input type="text"  placeholder="Cni" id="cni_patient_search" class="input_text"></div>
            </div>
<br>
<div class="container_inputs_search">
    <div class="input_item_search"><input type="text"  placeholder="Adresse" id="adresse_patient_search"  class="input_text"></div><br>
    <div class="input_item_search"><input type="text"  placeholder="Telephone" id="Telephone_patient_search" class="input_text"></div>
    <div class="input_item_search"><input type="text"  placeholder="Date de naissance" id="Date_Naissance_patient_search" class="input_text"></div>
</div>
<br>
<input type="button" value="Chercher" onclick="chercher_patient();"  class="inputs_btn">
<input type="button" value="Actualiser" onclick="actualiser_patient();" class="inputs_btn">
<br><br>
        <div class="list_items">
<table id="table_liste">
    <thead>
            <tr><th><th>Nom</th><th>Prenom</th><th>Cni</th><th colspan="3">Option</th></tr>
    </thead>
     <tbody id="List_patient">
        <tr>
            {{-- <td><img src="" alt="" class="img_patient"></td><td>Nassim</td><td>Nassim</td><td>Elo</td><td>Nassim</td><td><ion-icon class="icon_table icon_detail" onclick="show_patient_detail();" name="alert-circle-outline"></ion-icon></td><td><ion-icon class="icon_table icon_update" name="pencil-outline"></ion-icon></td><td><ion-icon class="icon_table icon_delete" name="close-circle-outline"></ion-icon></td> --}}
        </tr>
     </tbody>
</table>
</div>

            </center>
        </div>
        <br>

             <div class="box_item">
               <center>
                   <br>
                <h3 class="title">Formulaire de Patient</h3>
                <br>
                <div class="container_inputs">
                    <input type="text" style="display:none"  id="id_patient"  >
                    <div class="input_item"><input type="file" accept="image/*" id="img_patient" class="input_text"></div><br>
              </div>

                <div class="container_inputs">
                    <div class="input_item"><input type="text"  placeholder="Nom" id="nom_patient"  class="input_text"></div><br>
                    <div class="input_item"><input type="text"  placeholder="Prenom" id="prenom_patient" class="input_text"></div>
                </div>
                <br>
                <div class="container_inputs">
                    <div class="input_item"><input type="text"   placeholder="CNI" id="cni_patient"  class="input_text"></div><br>
                    <div class="input_item"><input type="text"  placeholder="Adresse" id="Adresse_patient" class="input_text"></div>
                </div>
                <br>
                <div class="container_inputs">
                    <div class="input_item"><input type="text"   placeholder="Telephone" id="Telephone_patient"  class="input_text"></div><br>
                    <div class="input_item"><input type="text"  placeholder="Date de naissance" id="Date_Naissance_patient" class="input_text"></div>
                </div>
<br>
<input type="button" value="Insérer" id="insert_update_button" onclick="insert_update_patient();" class="inputs_btn">
<input type="button"  value="Annuler" onclick="annuler_patient()" class="inputs_btn">

               </center>
             </div>
     </div>
 </section>   
 <!-- end section patient -->
     <!-- section Visite  -->
  <div id="RDV"></div>
 <section  class="section section_f">

     <center>
         <br>
        <h1>Gestion Des Rendez vous</h1>
        <br>
        <!-- 
            Gestion RDV
            id_admin
            id_patient
            date
            heure
            status
         -->
     </center>
     <div  class="contaier_boxes">
      
             <div class="box_item">
                 <center>
                    <br>
                    <h3 class="title">Liste des Rendez-vous</h3>
                   <br>
                   <div class="container_inputs_search">
                    <div class="input_item_search"><input type="text" placeholder="Patient" name="" id="patient_RDV_value_chercher" class="input_text"></div><br>
                    <div class="input_item_search"><select name="" id="Patient_RDV_by_chercher" class="input_text select_text">
                        <option value="CNI">CNI</option>
                        <option value="Tel">Tel</option>
                        <option value="Nom & prenom">Nom & prenom</option></select></div>
                    <div class="input_item_search"><input type="text" placeholder="Date" name="" id="date_RDV_chercher" class="input_text"></div>
                </div>
    <br>
    <div class="container_inputs_search">
        <div class="input_item_search"><input type="text" placeholder="Temps" name="" id="heure_RDV_chercher" class="input_text"></div>
        <div class="input_item_search"><select name="" id="status_RDV_chercher" class="input_text select_text">
            <option value="Status">Status</option>
            <option value="Rendez-vous à venir">Rendez-vous à venir</option>
            <option value="En salle d'attente">En salle d'attente</option>
            <option value="En consultation">En consultation</option>
            <option value="Vu">Vu</option>
            <option value="Absent excusé">Absent excusé</option>
            <option value="Absent non excusé">Absent non excusé</option>
        </select>
    </div>
    <div class="input_item_search"></div><br>
    </div>
    <br>
    <input type="button" value="Chercher" onclick="chercher_rdv();"  class="inputs_btn">
    <input type="button" value="Actualiser" onclick="annuler_RDV();" class="inputs_btn">
    <br>
                    <div class="List_RDV">
                      
<!-- HERE -->

                </div>
                 </center>

             </div>
             <br>
             <div class="box_item">
                <center>
                    <br>
<h3>Formulaire de RDV</h3>
<br>
<div class="container_input">
    <div class="input_text_item"><input type="text" placeholder="Patient" name="" id="patient_RDV_value" class="input_text"></div><br>
    <div class="input_text_item"><select name="" id="Patient_RDV_by" class="input_text select_text">
    <option value="CNI">CNI</option>
    <option value="Tel">Tel</option>
    <option value="Nom & prenom">Nom & prenom</option></select>
</div>
</div>
<br>

<div class="container_input">
    <div class="input_text_item"><input type="text" placeholder="Date" name="" id="date_RDV" class="input_text"></div><br>
    <div class="input_text_item"><input type="text" placeholder="Temps" name="" id="heure_RDV" class="input_text"></div> 

</div>
<br>
<div class="container_input">
    <div class="input_text_item">
<select name="" id="status_RDV" class="input_text select_text">
        <option value="Status">Status</option>
        <option value="Rendez-vous à venir">Rendez-vous à venir</option>
        <option value="En salle d'attente">En salle d'attente</option>
        <option value="En consultation">En consultation</option>
        <option value="Vu">Vu</option>
        <option value="Absent excusé">Absent excusé</option>
        <option value="Absent non excusé">Absent non excusé</option>
</select>
</div>
    <div style="visibility: hidden;" id="id_rdv" class="input_text_item"><input type="text" name="" id="" class="input_text"></div>               
    </div>
    <br>
    <input type="button" value="Insérer" id="insert_update_button_rdv" onclick="insert_update_RDV();" class="inputs_btn">
    <input type="button"  value="Annuler" onclick="annuler_RDV();" class="inputs_btn">

                </center>
            </div>
            
     </div>
 </section>   
<div id="visites"></div>
 <section  class="section section_f">
    <center>
       <h1>Gestion des visites</h1>
       <br>
       <div  class="contaier_boxes">
        <div class="box_item">
            <center>
                <br>
                <h3 class="title">Liste des Visite</h3>
               <br>
               <div class="container_inputs_search">
                <div class="input_item_search"><input type="text" placeholder="Patient" name="" id="patient_visite_value_chercher" class="input_text"></div><br>
                <div class="input_item_search"><select name="" id="Patient_visite_by_chercher" class="input_text select_text">
                    <option value="CNI">CNI</option>
                    <option value="Tel">Tel</option>
                    <option value="Nom & prenom">Nom & prenom</option></select></div>
                <div class="input_item_search"><input type="text" placeholder="Date" name="" id="date_visite_chercher" class="input_text"></div>
            </div>
<br>
<div class="container_inputs_search">
    <div class="input_item_search input_item_time">Debut :<input type="time" placeholder="Debut" name="" id="debut_visite_chercher" class="input_text input_time_search"></div>
    <div class="input_item_search input_item_time">Fin :<input type="time" placeholder="Fin" name="" id="fin_visite_chercher" class="input_text input_time_search"></div>
    <div class="input_item_search"><input type="text" placeholder="Prix" name="" id="prix_visite_chercher" class="input_text"></div>
<br>
</div>
<br>
<input type="button" value="Chercher" onclick="chercher_visite();"  class="inputs_btn">
<input type="button" value="Actualiser" onclick="annuler_visite();" class="inputs_btn">
<br>
            </center>
            <br>
            <div class="list_items">
                <table id="table_liste">
                    <thead>
                            <tr><th></th><th>Nom</th><th>Prenom</th><th>Date</th><th>Prix</th><th colspan="3">Option</th></tr>
                    </thead>
                     <tbody id="List_visite">
                        <tr>
                            <td><img src="" alt="" class="img_patient"></td><td>Nassim</td><td>Nassim</td><td>Nassim</td><td>Elo</td><td><ion-icon class="icon_table icon_detail" onclick="show_patient_detail();" name="alert-circle-outline"></ion-icon></td><td><ion-icon class="icon_table icon_update" name="pencil-outline"></ion-icon></td><td><ion-icon class="icon_table icon_delete" name="close-circle-outline"></ion-icon></td>
                            
                        </tr>
                     </tbody>
                </table>
                </div>
                    
        </div><br>
        <div class="box_item">
            <center>
                                   <br>
                <h3 class="title">Formulaire de Visite</h3>
                <br>
                <div class="container_input">
                    <input type="text" style="display: none" id="id_visite">
                    <div class="input_item"><input type="text"    placeholder="Patient" id="patient_visite_value"  class="input_text"></div><br>
                    <div class="input_text_item">
                    <select name="" id="Patient_visite_by" class="input_text select_input">
                    <option value="CNI">CNI</option>
                    <option value="Tel">Tel</option>
                    <option value="Nom & prenom">Nom & prenom</option></select>
                </div>
                </div>
                <br>
                
                <div class="container_inputs">
                    <div class="input_item input_item_time">Debut :<input type="time"  placeholder="Début" id="debut_visite"  class="input_text_time"></div><br>
                    <div class="input_item input_item_time">Fin :<input type="time"  placeholder="Fin" id="fin_visite" class="input_text_time"></div>
                </div>
<br>             
                <div class="container_inputs">
                    <div class="input_item"><input type="text"  placeholder="Prix" id="prix_visite"  class="input_text"></div><br>
                    <div class="input_item"><input type="text"  placeholder="Date" id="date_visite" class="input_text"></div>
                </div>
<br>              
<div class="container_inputs_full">
    <div class="input_item_full"> <textarea id="desc_visite" cols="30" rows="5"></textarea></div>
</div>
<br>
<input type="button" value="Insérer" id="insert_update_button_visite" onclick="insert_update_visite();" class="inputs_btn medicament_btn">
<input type="button"  value="Annuler"  onclick="annuler_visite();" class="inputs_btn medicament_btn">
<br>
            </center>
        </div>
       </div>        
 </section>
  <!-- end section Visite -->
  <!-- section Medicamment -->
   <section  class="section section_f">
   <center>
    <h1 class="title">Gestion Medicament</h1>
     <div  class="contaier_boxes">
        <div class="box_item">
            <center>
                <br>
                <h3 class="title">Liste de Medicament</h3>
                <br>
                <div class="container_inputs_search">
                    <div class="input_item_search"><input type="text" placeholder="Code" name="" id="code_medicament_chercher" class="input_text"></div><br>
                    <div class="input_item_search"><input type="text" placeholder="Designation" name="" id="Designation_medicament_chercher" class="input_text"></div>
                    <div class="input_item_search">
                        <select name="" id="format_medicament_chercher" class="input_text select_text">
                        <option value="">Choisir un format</option>
                        <option value="Les comprimés">Les comprimés</option>
                        <option value="Les comprimés à libération prolongée ">Les comprimés à libération prolongée </option>
                        <option value="Les gélules">Les gélules</option>
                        <option value="Les gélules à libération prolongée">Les gélules à libération prolongée</option>
                        <option value="Les sachets">Les sachets</option>
                        <option value="Les suppositoires">Les suppositoires</option>
                        <option value="Les collyres">Les collyres</option>
                        <option value="Les injectables">Les injectables</option>
                        <option value="Les granules">Les granules</option>
                        <option value="Les sirops">Les sirops</option> 
                        <option value="Les solutions buvables">Les solutions buvables</option> 
                        <option value="Les pommades">Les pommades</option> 
                        <option value="Les crèmes">Les crèmes</option> 
                        <option value="Les bains de bouche">Les bains de bouche</option> 
                        <option value="Les patchs">Les patchs</option>
                        </select>
                    </div>
                </div>
    <br>
    <div class="container_inputs_search">
        <div class="input_item_search"><input type="text" placeholder="Date" name="" id="date_medicament_chercher" class="input_text"></div><br>
        <div class="input_item_search"><input type="text" placeholder="Stock Actuel" name="" id="SA_chercher_medicament_chercher" class="input_text"></div><br>
        <div class="input_item_search"><input type="text" placeholder="Stock Minimale" name="" id="SM_medicament_chercherr" class="input_text"></div>
    <br>
    </div>
    <br>
    <div class="container_inputs_search">
        <div class="input_item_search"><input type="text" placeholder="Prix" name="" id="prix_chercher_medicament_chercher" class="input_text"></div><br>
        <div class="input_item_search input_item_search_medicament" style="display:flex;">
            <input type="button" value="Chercher" onclick="chercher_medicament();"  class="inputs_btn">&nbsp;
            <input type="button" value="Actualiser" onclick="annuler_medicament();" class="inputs_btn">
            </div><br>
        {{-- <div class="input_item_search"><input type="text" style="visibility:hidden;" placeholder="Prix" name="" id="prix_visite_chercher" class="input_text"></div> --}}
    <br>
    </div>
<br>
                <div class="list_items">
                    <table id="table_liste">
                        <thead>
                                <tr><th>Code</th><th>Designation</th><th>Format</th><th>Prix</th><th colspan="3">Option</th></tr>
                        </thead>
                         <tbody id="List_medicament">
                            <tr>
                                <td>Nassim</td><td>Nassim</td><td>Nassim</td><td>Elo</td><td><ion-icon class="icon_table icon_detail" onclick="show_patient_detail();" name="alert-circle-outline"></ion-icon></td><td><ion-icon class="icon_table icon_update" name="pencil-outline"></ion-icon></td><td><ion-icon class="icon_table icon_delete" name="close-circle-outline"></ion-icon></td>
                                
                            </tr>
                         </tbody>
                    </table>
                    </div>
                        
            </center>
        </div>
        <br>
        <div class="box_item box_item_formulaire_visite">
            <center>    
            <br>
            <h3 class="title">Formulaire de Medicament</h3>
            <br>
            <div class="container_inputs">
                <div class="input_item"><input type="text"  placeholder="Code" id="code_Medicament"  class="input_text"></div><br>
                <div class="input_item"><input type="text"  placeholder="Designation" id="des_Medicament" class="input_text"></div>
            </div>
            <br>
            <div class="container_inputs">
                <div class="input_item">
                    <select  id="format_Medicament" class="input_text">
                        <option value="">Choisir un format</option>
                        <option value="Les comprimés">Les comprimés</option>
                        <option value="Les comprimés à libération prolongée ">Les comprimés à libération prolongée </option>
                        <option value="Les gélules">Les gélules</option>
                        <option value="Les gélules à libération prolongée">Les gélules à libération prolongée</option>
                        <option value="Les sachets">Les sachets</option>
                        <option value="Les suppositoires">Les suppositoires</option>
                        <option value="Les collyres">Les collyres</option>
                        <option value="Les injectables">Les injectables</option>
                        <option value="Les granules">Les granules</option>
                        <option value="Les sirops">Les sirops</option> 
                        <option value="Les solutions buvables">Les solutions buvables</option> 
                        <option value="Les pommades">Les pommades</option> 
                        <option value="Les crèmes">Les crèmes</option> 
                        <option value="Les bains de bouche">Les bains de bouche</option> 
                        <option value="Les patchs">Les patchs</option>
                    </select>
                </div><br>
                <div class="input_item"><input type="text"  placeholder="Date Expiration" id="date_exp_Medicament" class="input_text"></div>
            </div>
            <br>            
            <div class="container_inputs">
                <div class="input_item"><input type="text"  placeholder="Stock Actuel" id="SA_Medicament"  class="input_text"></div><br>
                <div class="input_item"><input type="text"  placeholder="Stock Minimale" id="SM_Medicament" class="input_text"></div>
            </div>
            <br>
            <div class="container_inputs">
                <div class="input_item"><input type="text"  placeholder="Prix" id="prix_Medicament"  class="input_text"></div><br>
                <div class="input_item"><input type="text" id="id_medicament" style="visibility:hidden" class="input_text"></div>
            </div>
            <br>
            <input type="button" value="Insérer" id="insert_update_button_medicament" onclick="insert_update_medicament();" class="inputs_btn">
            <input type="button"  value="Annuler" onclick="annuler_medicament();" class="inputs_btn">
        
        </center>    
        </div>
      </div>
   </center>
</section>
<section  class="section section_ordonnance">
    <center>
        <h1 class="title">Gestion Ordonnance</h1>
         <div  class="contaier_boxes section_ordonnance_box_container">
            <div class="box_item box_item_ordonnance">
            <center>
             <br>
             <h3 class="title">Liste des Ordonnace</h3>
            <br>
            <div class="container_input">
                <input type="text" style="display: none" id="id_visite">
                <div class="input_item"><input type="text"    placeholder="Patient" id="patient_ordonnance_value_search"  class="input_text"></div><br>
                <div class="input_text_item">
                <select name="" id="Patient_ordonnance_by_search" class="input_text select_input">
                <option value="CNI">CNI</option>
                <option value="Tel">Tel</option>
                <option value="Nom & prenom">Nom & prenom</option></select>
            </div>
            </div>
            <br>
            <div class="container_input">
                <div class="input_item"><input type="text"    placeholder="Medicament" id="Medicament_ordonnance_value_search"  class="input_text"></div><br>
                <div class="input_text_item">
                <select name="" id="Medicament_ordonnance_by_search" class="input_text select_input">
                <option value="code_medicament">Code</option>
                <option value="desi">Designation</option></select>
            </div>
            </div>
            <br>
            <div class="container_input">
                <div class="input_item">
                    <input type="text"    placeholder="Date:aaaa-mm-jj" id="date_ordonnance_search"  class="input_text">
                </div>
<br>
<div class="input_item">          
    <input type="button" value="Chercher"  onclick="chercher_ordonnance();" class="inputs_btn">
    <input type="button"  value="Actualiser" onclick="actualiser_ordonnance();" class="inputs_btn">               
</div>

            </div>
<br>
<div class="list_items list_items_ordonnance">
    <table id="table_liste">
        <thead>
                <tr><th>CNI</th><th>Nom</th><th>Prenom</th><th>Date</th><th colspan="3">Option</th></tr>
        </thead>
         <tbody id="List_ordonnance">

         </tbody>
    </table>
    </div>          

            </center>    
            </div><br>
            <div class="box_item box_item_ordonnance">
                <center>
                    <br>
                    <h3 class="title">Formulaire Ordonnance</h3>
                    <br>

                    <div class="container_input">
                        <input type="text" style="display: none" id="id_ordonnance">
                        <div class="input_item"><input type="text"    placeholder="Patient" id="patient_ordonnance_value"  class="input_text"></div><br>
                        <div class="input_text_item">
                        <select name="" id="Patient_ordonnance_by" class="input_text select_input">
                        <option value="CNI">CNI</option>
                        <option value="Tel">Tel</option>
                        <option value="Nom & prenom">Nom & prenom</option></select>
                    </div>
                    </div>
                    <br>
                    <div class="container_input">
                        <div class="input_item"><input type="text"    placeholder="Medicament" id="Medicament_ordonnance_value"  class="input_text"></div><br>
                        <div class="input_text_item">
                        <select name="" id="Medicament_ordonnance_by" class="input_text select_input">
                        <option value="code_medicament">Code</option>
                        <option value="desi">Designation</option></select>
                    </div>
                    </div>
                    <br>
                    <div class="container_input">
                        <div class="input_item">          
                            <input type="button" value="Chercher"  onclick="chercher_medicament_ordonnance();" class="inputs_btn">
                            <input type="button"  value="Actualiser" onclick="actualiser_medicament_ordonnance();" class="inputs_btn">               
                        </div>
                        <br>
                        <div class="input_item">
                            <input type="datetime-local"    placeholder="Date:aaaa-mm-jj" id="date_ordonnance"  class="input_text">
                        </div>
                    </div>
                    {{-- from here --}}
     <br>
     <br>
     <div class="container_input">
        <div class="input_item"> 
            <div id="list_ordonnance_medicament_exist" class="list_ordonnance_medicament" >
               {{-- <div class="item_medicamment_ordonnance"> 
                   <span class="ticket_MO">Code :</span><span class="value_MO" id="codeMedicament_ordonnance">CD704354</span><br>
                   <span class="ticket_MO">Designation :</span><span class="value_MO" id="codeMedicament_ordonnance">Doliprane</span><br>
                   <span class="ticket_MO">Format :</span><span class="value_MO" id="codeMedicament_ordonnance">Pomade</span>
               </div>
               <div class="item_medicamment_ordonnance"> 
                <span class="ticket_MO">Code :</span><span class="value_MO" id="codeMedicament_ordonnance">CD704354</span><br>
                <span class="ticket_MO">Designation :</span><span class="value_MO" id="codeMedicament_ordonnance">Doliprane</span><br>
                <span class="ticket_MO">Format :</span><span class="value_MO" id="codeMedicament_ordonnance">Pomade</span>
            </div> --}}
            </div> 
        </div><br>
        <div class="input_item"> <div id="list_ordonnance_medicament_paniet" class="list_ordonnance_medicament"></div>  </div>
     </div>
     <br>
     <input type="button" value="Insérer" id="insert_update_button_ordonnance" onclick="insert_update_ordonnance();" class="inputs_btn">
     <input type="button" value="Vider le panier"  onclick="ViderPanier();" class="inputs_btn">
     <input type="button"  value="Annuler" onclick="annuler_ordonnance();" class="inputs_btn">
 
                </center>
            </div>
         </div>
    </center>
</section>
<br><br>
  <!-- end section Medicamment -->

  <br>
 

 <!-- button go up -->
 <a href="#patients">
 <input type="button" value="^" class="btn_go_up">
</a>
<!-- end button go up -->
    <script src="{{asset('assets/js/main.js')}}"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>