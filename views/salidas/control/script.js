// *INTERACCION JS CSS
let asientos = document.querySelectorAll(".bus__asiento");
function showModal() {
   modalInfo.classList.remove("hidden");
}
function hideModal() {
   modalInfo.classList.add("hidden");
}
function showList() {
   getListP();
   hideModal();
   pasajerosBox.classList.toggle("hidden");
   btnshowList.classList.toggle("hidden");
}

btnshowList.addEventListener("click", (e) => {
   showList();
});
pasajeros__btnBack.addEventListener("click", showList);

modalInfo__back.addEventListener("click", hideModal);

//? PETICIONES
function getSeats(condicion, element) {
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
         element.innerHTML = r;
      });
}
function getAllSeats() {
   getSeats("left", bus__left);
   getSeats("right", bus__right);
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
function getListP() {
   //Obtnego el id de la salida en la url
   const urlParams = new URLSearchParams(window.location.search);
   let idS = urlParams.get('id');
   fetch("readListp.php", {
      method: "POST",
      body: new URLSearchParams(`id=${idS}`),
   })
      .then((r) => r.text())
      .then((r) => {
         pasajeros__table__tbody.innerHTML = r;
      });
}

// envio del formulario con onsubmit en el form RESERVAR ASIENTO
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
         } else if (r == "ok_m") {
            getAllSeats();
            pasajerosBox.classList.add("hidden");
            btnshowList.classList.remove("hidden");
            Swal.fire({
               position: "center",
               icon: "success",
               title: "Reserva modificada exitosamente",
               showConfirmButton: false,
               timer: 1500,
            });
         } else {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: "Ocurrió un error!",
            });
            console.log(r);
         }
      });
}
// ACCIONES DE RESERVAS
function deleteR(idR) {
   Swal.fire({
      title: "Estás seguro de eliminar esta reserva?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí",
      cancelButtonText: "No",
   }).then((result) => {
      if (result.isConfirmed) {
         fetch("delete_r.php", {
            method: "POST",
            body: new URLSearchParams(`id=${idR}`),
         })
            .then((r) => r.text())
            .then((r) => {
               if (r == "ok") {
                  // hideModal();
                  getAllSeats();
                  getListP();
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
   });
}

function editR(idR) {
   showModal();
   fetch("edit_r.php", {
      method: "POST",
      body: new URLSearchParams(`id=${idR}`),
   })
      .then((r) => r.text())
      .then((r) => {
         modalInfo__info.innerHTML = r;
      });
}
// redireccionar a boleta.php
function boleta(idR,idS) {
   window.open(`boleta.php?id_reserva=${idR}&id_salida=${idS}`,"_blank");
}