<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&family=Ubuntu:wght@300&display=swap');
   :root{
      --color-main:#101631;
      --color-main-hover:#131b3f;
      --color-cyan:#159A9C;
      --color-light:#FFFFFF;
      --color-light-green:#DEEFE7;
      --color-gray:#e4efff;
      --color-light-gray:#d6e2ef;
      --font-poppins:'Poppins', sans-serif;
      --font-ubuntu:'Ubuntu', sans-serif;;
   }
   * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: var(--font-poppins);
   }
   .container_all{
      width: 100%;
      height: 100vh;
      display: flex;
      overflow:hidden;
   }
   .menu {
      position: relative;
      width: 175px;
      padding: 5px;
      background: var(--color-main);
      transition: all 0.3s;
      height: 100vh;
      display:flex;
      flex-direction: column;
      gap:1em;
      justify-self: start;
   }
   .menu.hide {
      width: 52px;
   }
   .menu__iconBar{
      position: relative;
      display: inline;
      align-self: end;
      padding:0 3px;
      font-size: larger;
      cursor: pointer;
      color: white;
      transition: all 0.3s;
   }
   .menu__iconBar.center {
      position: relative;
      margin:0 auto;
      text-align: center;
   }
   .menu__logo {
      position: relative;
      width: 98%;
      height: 100px;
      transition: all 0.3s;
   }
   .menu__logo img {
      width: 100%;
      height: 100%;
      object-fit: contain;
   }
   .menu__nav {
      position: relative;
      width: 100%;
      display: flex;
      justify-content: center;
   }
   .menu__nav ul {
      width: 100%;
      list-style: none;
   }
   .menu__item{
      position: relative;
      width: 100%;
      border-radius: 5px;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      -ms-border-radius: 5px;
      -o-border-radius: 5px;
      transition: all 0.3s;
      -webkit-transition: all 0.3s;
      -moz-transition: all 0.3s;
      -ms-transition: all 0.3s;
      -o-transition: all 0.3s;
   }
   .menu__item:hover {
      background: var(--color-main-hover);
   }
   .menu.hide .menu__item::before {
      content: var(--text);
      position: absolute;
      background: var(--color);
      border-radius: 3px;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      -ms-border-radius: 3px;
      -o-border-radius: 3px;
      font-size:medium;
      color: white;
      width: 0;
      height: 0;
      bottom: 50%;
      left: 90%;
      text-align: center;
      overflow: hidden;
      transition: all 0.3s;
      z-index: 1000;
   }
   .menu.hide .menu__item:hover::before {
      position: absolute;
      width: auto;
      height: auto;
      padding: 3px 7px;
      z-index: 1000;
   }
   .menu__link{
      display: block;
      padding:10px;
      width: 100%;
      height: 100%;
      text-decoration: none;
      font-size: medium;
      color: white;
      white-space: nowrap;
      overflow: hidden;
   }
   .menu.hide .menu__link{
      text-align: center;
   }
   .menu__link span{
      margin-left: 10px;
   }
   .menu.hide .menu__linkText {
      display: none;
   }
   .menu__userBox{
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 40px;
      display: flex;
      align-items: center;
      background: var(--color-main);
   }
   .menu__userName{
      width: 100%;
      padding-left: 10px;
      font-size:small;
      overflow: hidden;
      white-space: nowrap;
      text-overflow:ellipsis;
      text-align: center;
      color:var(--color-light-green);
   }
   .menu__btnLogout{
      margin: 0 auto;
      padding: 5px 10px;
      display:grid;
      place-items: center;
      font-size:medium;
      color:white;
   }
   .menu__btnLogout:hover{
      background: var(--color-main-hover);
      border-radius:3px; 
   }
</style>
<header class="menu">
   <div class="menu__iconBar"><i class="uil uil-bars"></i></div>
   <div class="menu__logo">
      <img src="http://localhost/transportes/assets/img/logo.png" id="img-logo" alt="logotipo">
   </div>
   <nav class="menu__nav">
      <ul>
         <li class="menu__item" style="--color: #3dcda2; --text: 'Salidas'">
            <a href="http://localhost/transportes/views/salidas/" class="menu__link">
               <i class="uil uil-map-marker-plus"></i>
               <span class="menu__linkText">Salidas</span>
            </a>
         </li>
         <!-- ACCESO  SOLO A ADMINISTRADOR -->
         <?php 
            if($_SESSION["type"]==1){
         ?>
         <li class="menu__item" style="--color: #a70707; --text: 'Clientes'">
            <a href="http://localhost/transportes/views/clientes/" class="menu__link">
               <i class="uil uil-users-alt"></i>
               <span class="menu__linkText">Clientes</span>
            </a>
         </li>
         <li class="menu__item" style="--color: #09548a; --text: 'Vehículos'">
            <a href="http://localhost/transportes/views/vehiculos/" class="menu__link">
               <i class="uil uil-bus-alt"></i>
               <span class="menu__linkText">Vehículos</span>
            </a>
         </li>
         <li class="menu__item" style="--color: #e5d767; --text: 'Conductores'">
            <a href="http://localhost/transportes/views/conductores/" class="menu__link">
               <i class="uil uil-user-md"></i>
               <span class="menu__linkText">Conductores</span>
            </a>
         </li>
         <?php 
            }
         ?>
      </ul>
   </nav>
   <div class="menu__userBox">
      <h3 class="menu__userName menu__linkText"><?php echo $_SESSION['nombres_apes']; ?></h3>
      <a href="http://localhost/transportes/logout.php" class="menu__btnLogout" title="Cerrar sesión"><i class="uil uil-signout"></i></a>
   </div>
</header>

