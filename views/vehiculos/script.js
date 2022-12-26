categoria.addEventListener("change", () => {
   let intervalo = {
      max: "",
      min: "",
   };
   categoria.value == "M2"
      ? (intervalo = { max: 36, min: 28 })
      : (intervalo = { max: 54, min: 46 });
   asientos.disabled = false;
   asientos.placeholder = `Min. ${intervalo.min}, Máx. ${intervalo.max}`;
   asientos.min = intervalo.min;
   asientos.max = intervalo.max;
});

function getVehiculos() {
   fetch("read.php", {
      method: "POST",
      body: {},
   })
      .then((r) => r.text())
      .then((r) => {
         table_list.innerHTML = r;
      });
}
getVehiculos();

form_add.addEventListener("submit", (event) => {
   event.preventDefault();
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
               title: "Vehículo agregado exitosamente",
               showConfirmButton: false,
               timer: 1500,
            });
            id_vehiculo.value = "";
            form_add.reset();
            getVehiculos();
         } else if (r == "modificado") {
            Swal.fire({
               position: "center",
               icon: "success",
               title: "Vehículo modificado exitosamente",
               showConfirmButton: false,
               timer: 1500,
            });
            id_vehiculo.value = "";
            form_add.reset();
            getVehiculos();
            btnRegistrar.value = "Agregar";
            title_action.innerHTML = "Agregar Salida";
         } else {
            Swal.fire({
               icon: "error",
               title: "Oops...",
               text: "Ocurrió un error!",
            });
            console.log(r);
         }
      });
});

function editV(codV) {
   fetch("edit.php", {
      method: "POST",
      body: new URLSearchParams(`codV=${codV}`),
   })
      .then((r) => r.text())
      .then((r) => {
         if (r == "cannot") {
            Swal.fire({
               icon: "error",
               title: "No se puede editar el vehiculo",
               text: "El vehiculo ya tiene asignada una salida",
            });
         } else {
            r = JSON.parse(r);
            title_action.innerHTML = "Modificar Vehículo";
            asientos.disabled = false;
            id_vehiculo.value = r.id;
            placa.value = r.n_placa;
            vin.value = r.n_vin;
            marca.value = r.marca;
            categoria.value = r.categoria;
            asientos.value = r.total_asientos;
            btnRegistrar.value = "Actualizar";
         }
      });
}
function deleteV(codV) {
   Swal.fire({
      title: "Estás seguro de eliminar este vehículo?",
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
            body: new URLSearchParams(`codV=${codV}`),
         })
            .then((r) => r.text())
            .then((r) => {
               if (r == "cannot") {
                  Swal.fire({
                     icon: "error",
                     title: "No se puede eliminar el vehiculo",
                     text: "El vehiculo ya tiene asignada una salida",
                  });
               }else if (r == "ok") {
                  Swal.fire({
                     position: "center",
                     icon: "success",
                     title: "Vehículo eliminado exitosamente",
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
               getVehiculos();
            })
      }
   });
}
