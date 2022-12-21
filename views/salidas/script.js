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
            } else if(r == "modificado"){
               Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Salida modificada exitosamente",
                  showConfirmButton: false,
                  timer: 1500,
               });
               btnRegistrar.value = "Agregar";
               title_action.innerHTML = "Agregar Salida";
            }
            form_add.reset();
            mostrar_data();
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
               } else if(r=="cannot") {
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
            });
      }
   });
}

function editar(id) {
   fetch("edit.php", {
      method: "POST",
      body: new URLSearchParams(`id=${id}`),
   })
      .then((r) => r.json())
      .then((r) => {
         id_salida.value = r.id;
         origen.focus();
         origen.value = r.origen;
         destino.value = r.destino;
         fecha.value = r.fecha;
         hora.value = r.hora;
         monto.value = r.monto;
         btnRegistrar.value = "Actualizar";
         title_action.innerHTML = "Modificar Salida";
      });
}

function control(id) {
   window.location.href="control?id=" + id;
}