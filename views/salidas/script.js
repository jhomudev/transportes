function mostrar_data() {
   fetch("read.php", {
      method: "POST",
      body: {},
   })
      .then((r) => r.text())
      .then((r) => {
         table_list.innerHTML = r;
      });
}
mostrar_data();

function getEntities(entity, element) {
   fetch("disponibles.php", {
      method: "POST",
      body: new URLSearchParams(`entity=${entity}`),
   })
      .then((r) => r.text())
      .then((r) => {
         element.innerHTML = r;
      });
}
function getAllEntities() {
      getEntities("conductor", conductor);
      getEntities("vehiculo", vehiculo);
}
getAllEntities();

btnRegistrar.addEventListener("click", (e) => {
   e.preventDefault();
   fetch("create.php", {
      method: "POST",
      body: new FormData(form_add),
   })
      .then((r) => r.text())
      .then((r) => {
         if (r == "vacio") {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: "Completa todos los campos!",
            });
         } else {
            if (r == "ok") {
               Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Salida creada exitosamente",
                  showConfirmButton: false,
                  timer: 1500,
               });
            } else if (r == "modificado") {
               Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Salida modificada exitosamente",
                  showConfirmButton: false,
                  timer: 1500,
               });
               btnRegistrar.value = "Agregar";
               title_action.innerHTML = "Agregar Salida";
            } else {
               console.log(r);
            }
            id_salida.value = "";
            form_add.reset();
            mostrar_data();
            getAllEntities();
         }
      });
});

function eliminar(id) {
   Swal.fire({
      title: "Estás seguro de eliminar esta salida?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí",
      cancelButtonText: "No",
   }).then((result) => {
      if (result.isConfirmed) {
         fetch("delete.php", {
            method: "POST",
            body: new URLSearchParams(`id=${id}`),
         })
            .then((r) => r.text())
            .then((r) => {
               if (r == "ok") {
                  mostrar_data();
                  Swal.fire({
                     position: "center",
                     icon: "success",
                     title: "Salida eliminada exitosamente",
                     showConfirmButton: false,
                     timer: 1500,
                  });
               } else if (r == "cannot") {
                  Swal.fire({
                     icon: "error",
                     title: "No se pudo eliminar la salida",
                     text: "La salida tiene reservas, por lo cual no se puede eliminar",
                  });
               } else {
                  Swal.fire({
                     icon: "error",
                     title: "Oops...",
                     text: "Ocurrió un error!",
                  });
                  console.log(r);
               }
               getAllEntities();
            });
      }
   });
}

function editar(id) {
   getAllEntities();
   fetch("edit.php", {
      method: "POST",
      body: new URLSearchParams(`id=${id}`),
   })
      .then((r) => r.text())
      .then((r) => {
         if (r == "cannot") {
            Swal.fire({
               icon: "error",
               title: "No se puede editar la salida",
               text: "La salida tiene reservas, por lo cual no se puede modificar",
            });
         } else {
            r = JSON.parse(r);
            id_salida.value = r.idS;
            origen.focus();
            origen.value = r.origen;
            destino.value = r.destino;
            fecha.value = r.fecha;
            hora.value = r.hora;
            monto.value = r.monto;
            vehiculo.innerHTML += `<option selected value="${r.idV}">${r.n_placa}-${r.total_asientos}  asientos</option>`;
            conductor.innerHTML += `<option selected value="${r.idC}">${r.nombres} ${r.apellidos}-${r.licencia}</option>`;
            btnRegistrar.value = "Actualizar";
            title_action.innerHTML = "Modificar Salida";
         }
      });
}

function control(id) {
   window.location.href = "control?id=" + id;
}
