
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login Page</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href="{{asset('assets/css/style_login.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Nunito&display=swap" rel="stylesheet">
</head>
<body onload="slide_login_time();">
<div class="container_Big_dives">
    <div class="Div_Item">
        <center>
            <h1 class="Big_Title_1">Bienvenue, veuillez vous connecter</h1>
            <br>
            <div id="slide_login" onclick="slid_login();" class="image_login slide_image_login_1">
                
            </div>
        </center>
    </div>
    <div class="Div_Item">
        <div class="cnx_form">
            <!-- connection form -->
            <div class="Login_container">
                <div class="login_container_slider">

                    <div class="login_container_member">
                        <center>
                            <h1 class="Big_Title_2">Formulaire de connexion</h1>
                            <br>
                            <div class="form">
                                @csrf
                                <label class="label_input" for="login"><ion-icon name="person-outline"></ion-icon></label>
                                <input type="text" placeholder="Login"  id="login_cnx" class="input_form">
                                
                                <br>
                                <label class="label_input" for="pw">
                                    <ion-icon onclick="change_eye()" id="eye_on"  name="eye-outline"></ion-icon>
                                </label>
                                <input type="password" placeholder="Mot De Passe" id="pw_cnx" class="input_form">
                                <br>
                                <input type="button" onclick="login();" placeholder="Mot De Passe"   class="input_form_button"  value="Login">
                                <input type="button" placeholder="Mot De Passe" onclick="switch_login_inscrire('100%');"  class="input_form_button_login"  value="Sign up">
                                
                            </div>
                        </center>
                        
                    </div>
                    <div class="login_container_member">
                        <center>
                            <h1 class="Big_Title_2">Formulaire d'inscrire</h1>
                            <br>
                            <div class="form">
                                <input type="file"  id="img_insc" accept="image/*">
                                <input type="text" placeholder="Nom"  id="nom_insc" class="input_form">
                                <input type="text" placeholder="Prenom"  id="prenom_insc" class="input_form">
                   
                                <input type="text" placeholder="Login"  id="login_insc" class="input_form">
                                <input type="text" placeholder="password"  id="pw_insc" class="input_form">
                          
                                <br>
                                <input type="button" placeholder="Mot De Passe"  onclick="inscrire();" class="input_form_button"  value="Sign up">
                                <input type="button" placeholder="Mot De Passe" onclick="switch_login_inscrire('0');"   class="input_form_button_login"  value="Login">
                                
                            </div>
                        </center>

                    </div>
                </div>

            </div>
<!-- end connction form -->
<!-- inscrire form -->

<!-- end inscrire form -->
</div>

    </div>
    
</div>
<script src="{{asset('assets/js/script.js')}}"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>