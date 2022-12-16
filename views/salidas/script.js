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
         if (r == "ok") {
            Swal.fire({
               position: "center",
               icon: "success",
               title: "Salida creada exitosamente",
               showConfirmButton: false,
               timer: 1500,
            });
         }
         form_add.reset();
         mostrar_data();
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
      cancelButtonText: "No"
   }).then((result) => {
      if (result.isConfirmed) {
         fetch("delete.php", {
            method: "POST",
            body: new URLSearchParams(`id=${id}`)
         }).then((r) => r.text()).then((r) => {
            if (r == "ok") {
               mostrar_data();
               Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Salida eliminada exitosamente",
                  showConfirmButton: false,
                  timer: 1500,
               });
               }
            });
      }
   });
}
