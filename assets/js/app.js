// funcion ocultar barra menu en panel de admin
const btn = document.querySelector(".menu__iconBar");
let menu = document.querySelector(".menu");
let opcion_title = document.querySelectorAll(".menu__linkText");
function hide() {
   //poniendo la clase
   menu.classList.toggle("hide");
   btn.classList.toggle("center");
   opcion_title.forEach((item) => item.classList.toggle("hide"));
}
btn.addEventListener("click", hide);

//funcion que valida solo entrada de numeros
function valide(event) {
   if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;
}
//funcion de iframe animación
let iframe_res = document.querySelector("#iframe_res");
let iframe_pas = document.querySelector("#iframe_pasajeros");
let btn_cerrar_res = document.querySelector(".btn-cerrar.res");
let btn_cerrar_pasa = document.querySelector(".btn-cerrar.pas");
function mostrar_res() {
   iframe_res.classList.add("active");
   btn_cerrar_res.classList.add("active");
}
function cerrar_res() {
   iframe_res.classList.remove("active");
   btn_cerrar_res.classList.remove("active");
}
function mostrar_pas() {
   iframe_pas.classList.toggle("active");
   btn_cerrar_pasa.classList.toggle("active");
}
function soloNumeros(e) {
   var key = e.charCode;
   return key >= 48 && key <= 57;
}
function soloPrecio(event) {
   let tecla = (document.all) ? event.keyCode : event.which;
   if ((tecla<48 || tecla>57) && tecla!=46) return false
}