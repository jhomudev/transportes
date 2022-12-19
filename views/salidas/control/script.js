// *INTERACCION JS CSS
let asientos = document.querySelectorAll(".bus__asiento");
function showModal() {
   modalInfo.classList.remove("hidden");
}
function hideModal() {
   modalInfo.classList.add("hidden");
}
function showList() {
   pasajerosBox.classList.toggle("hidden");
   btnshowList.classList.toggle("hidden");
}

btnshowList.addEventListener("click", (e) => {
   showList();
});
pasajeros__btnBack.addEventListener("click", showList);

modalInfo__back.addEventListener("click", hideModal);

//? PETICIONES
function getSeats(condicion, idElement) {
   // obteniendo los datos de la url get
   let params = new URLSearchParams(location.search);
   let id_salida = params.get("id");
   fetch("readSeats.php", {
      method: "POST",
      body: new URLSearchParams(
         `id_salida=${id_salida}&condicion=${condicion}`
      ),
   })
      .then((r) => r.text())
      .then((r) => {
         document.getElementById(idElement).innerHTML = r;
      });
}
function getAllSeats() {
   getSeats("<=18", "bus__left");
   getSeats(">18", "bus__right");
}
getAllSeats();

function getInfoSeat(idSeat) {
   showModal();
   fetch("infoSeat.php", {
      method: "POST",
      body: new URLSearchParams(`id=${idSeat}`),
   })
      .then((r) => r.text())
      .then((r) => {
         modalInfo__info.innerHTML = r;
      });
}
// envio del formulario con onsubmit en el form
function submitForm(event) {
   event.preventDefault();
   console.log("submit");
   fetch("reservar_a.php", {
      method: "POST",
      body: new FormData(modaliInfo__form),
   })
      .then((r) => r.text())
      .then((r) => {
         if (r == "vacio") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: "Completa todos los campos!",
            });
         } else if (r == "ok") {
            getAllSeats();
            Swal.fire({
               position: "center",
               icon: "success",
               title: "Asiento reservado exitosamente",
               showConfirmButton: false,
               timer: 1500,
            });
         } else {
            console.log(r);
         }
      });
}
// ACCIONES
function deleteR(idR) {
   fetch("delete_r.php", {
      method: "POST",
      body: new URLSearchParams(`id=${idR}`),
   })
      .then((r) => r.text())
      .then((r) => {
         if (r == "ok") {
            hideModal();
            bus.focus();
            getAllSeats();
            Swal.fire({
               position: "center",
               icon: "success",
               title: "Reserva eliminada exitosamente",
               showConfirmButton: false,
               timer: 1500,
            });
         } else {
            console.log(r);
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: "Al parecer ocurrióun error!",
            });
         }
      });
}
