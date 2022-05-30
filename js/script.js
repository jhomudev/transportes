//funcion que valida solo entrada de numeros
function valide(event){
    if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
}
//funcion de iframe animación
let iframe_res=document.querySelector("#iframe-res");
let iframe_pas=document.querySelector("#iframe-pasajeros");
let btn_cerrar=document.querySelector("#btn-cerrar");
let btn_cerrar_pasa=document.querySelector("#btn-cerrar-pasa");
function mostrar_res(){
    iframe_res.classList.add("active"); 
    //btn_cerrar_pasa.classList.add("active"); 
}
function cerrar_res(){
    iframe_res.classList.remove("active"); 
    //btn_cerrar_pasa.classList.remove("active"); 
}
function mostrar_pas(){
    iframe_pas.classList.toggle("active"); 
    btn_cerrar.classList.toggle("active");
    //btn_cerrar_pasa.classList.toggle("active"); 
}

