function getConductores() {
   fetch("read.php", {
      method: "POST",
      body: {},
   })
      .then((r) => r.text())
      .then((r) => {
         table_list.innerHTML = r;
      });
}
getConductores();


// envio del formulario
form_add.addEventListener("submit", (event) => {
   event.preventDefault();
   console.log("submit");
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
         } else if (r == "ok") {
            Swal.fire({
               position: "center",
               icon: "success",
               title: "Conductor registrado exitosamente",
               showConfirmButton: false,
               timer: 1500,
            });
            getConductores();
            form_add.reset();
         } else if (r == "modificado") {
            Swal.fire({
               position: "center",
               icon: "success",
               title: "Conductor modificado exitosamente",
               showConfirmButton: false,
               timer: 1500,
            });
            getConductores();
            form_add.reset();
            id_conductor.value = "";
         } else {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: "Ocurrió un error. Complete los campos correctamente!",
            });
            console.log(r);
         }
      });
});

function editC(idC) {
   fetch("edit.php", {
      method: "POST",
      body: new URLSearchParams(`idC=${idC}`),
   })
      .then((r) => r.text())
      .then((r) => {
         if (r == "cannot") {
            Swal.fire({
               icon: "error",
               title: "No se puede editar el conductor",
               text: "El conductor ya tiene asignada una salida",
            });
         }else{
            r = JSON.parse(r);
            title_action.value = "Modificar conductor";
            id_conductor.value = r.id;
            dni.value = r.dni;
            nombres.value = r.nombres;
            apellidos.value = r.apellidos;
            licencia.value = r.licencia;
            telefono.value = r.telefono;
            btnRegistrar.value = "Actualizar";
         }
      });
}
function deleteC(idC) {
   Swal.fire({
      title: "Estás seguro de eliminar este conductor?",
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
            body: new URLSearchParams(`idC=${idC}`),
         })
            .then((r) => r.text())
            .then((r) => {
               if (r == "cannot") {
                  Swal.fire({
                     icon: "error",
                     title: "No se puede eliminar el conductor",
                     text: "El conductor ya tiene asignada una salida",
                  });
               }else if (r == "ok") {
                  Swal.fire({
                     position: "center",
                     icon: "success",
                     title: "Conductor eliminado exitosamente",
                     showConfirmButton: false,
                     timer: 1500,
                  });
               } else {
                  console.log(r);
                  Swal.fire({
                     icon: "error",
                     title: "Oops...",
                     text: "Al parecer ocurrió un error!",
                  });
               }
               getConductores();
            });
      }
   });
}
