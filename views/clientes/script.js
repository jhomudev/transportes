let entry = document.getElementById('keywords');
function mostrar_data(kw) {
   fetch("read.php", {
      method: "POST",
      body: new URLSearchParams(`keywords=${kw}`)
   })
      .then((r) => r.text())
      .then((r) => {
         table_list.innerHTML = r;
      })
}
mostrar_data("");
entry.addEventListener('keyup', (e) => mostrar_data(entry.value));
