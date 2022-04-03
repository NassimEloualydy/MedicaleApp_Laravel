function change_eye(){
    if(document.getElementById('eye_on').style.color=="gray"){
        document.getElementById('eye_on').style.color="black";
        document.getElementById('pw_cnx').type="text";

    }else{
        document.getElementById('eye_on').style.color="gray";
        document.getElementById('pw_cnx').type="password";

       }
}
function slide_login(){
    //slide_image_login_1
    document.getElementById('slide_login').classList.remove('image_login');
    if(document.getElementById('slide_login').classList[0]=="slide_image_login_1"){
        document.getElementById('slide_login').classList.remove('slide_image_login_1');
        document.getElementById('slide_login').classList.add('slide_image_login_2');
    }else if(document.getElementById('slide_login').classList[0]=="slide_image_login_2"){
        document.getElementById('slide_login').classList.remove('slide_image_login_2');
        document.getElementById('slide_login').classList.add('slide_image_login_3');
    }else{
        document.getElementById('slide_login').classList.remove('slide_image_login_3');
        document.getElementById('slide_login').classList.add('slide_image_login_1');

    } 
}
function slide_login_time(){
    setInterval('slide_login()',5000);
}
function switch_login_inscrire(d){
    document.querySelectorAll('.login_container_slider')[0].style.right=d;
}
function login(){
 var xhr=new XMLHttpRequest();
 xhr.onreadystatechange=function(){
     if(this.status==200 && this.readyState==4){
         if(this.responseText=="valide"){
            location.href="index";
         }else 
         alert(this.responseText);         
     }
 }
 xhr.open("POST","/login",false);
//  login_cnx
//  pw_cnx
var f=new FormData();
f.append("_token",document.getElementsByName('_token')[0].value);
f.append("login",document.getElementById("login_cnx").value);
f.append("pw",document.getElementById("pw_cnx").value);
 xhr.send(f);
}
function inscrire(){
    
    var nom=document.getElementById("nom_insc").value;
    var prenom=document.getElementById("prenom_insc").value;
    var login=document.getElementById("login_insc").value;
    var pw=document.getElementById("pw_insc").value;
    var img=document.getElementById("img_insc").files[0];
    if(nom!="" && prenom!="" && login!="" && pw!="" && document.getElementById("img_insc")!=0){

    var xhr=new XMLHttpRequest();
    xhr.onreadystatechange=function(){
        if(this.status==200 && this.readyState==4){
            if(this.responseText=="valide")
            {
                document.getElementById("nom_insc").value="";
                document.getElementById("prenom_insc").value="";
                document.getElementById("login_insc").value="";
                document.getElementById("pw_insc").value="";
                switch_login_inscrire('0');
                location.href="index";

            }
            else
            alert(this.responseText);
        }
    }
    xhr.open("POST","/inscrire",false);
var f=new FormData();
f.append("_token",document.getElementsByName('_token')[0].value);
f.append("nom",nom);
f.append("prenom",prenom);
f.append("login",login);
f.append("pw",pw);
f.append("img",img);
 xhr.send(f);
}else 
alert("SVP tout les champs sont obligatoire !!");

}
