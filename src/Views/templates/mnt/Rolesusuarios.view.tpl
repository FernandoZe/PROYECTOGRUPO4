<h1>Gestión de Roles De Usuarios</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Código</th>
        <th>Rol usuarios</th>
        <th>Estado</th>
        <th>Fecha Actual</th>
        <th>Fecha Expira</th>
        <th>
         
          <button id="btnAdd">Nuevo</button>
       
        </th>
      </tr>
    </thead>
    <tbody>
      {{foreach roles_usuarios}}
      <tr>
        <td>{{usercod}}</td>
        <td><a href="index.php?page=Mnt_Rolesusuario&mode=DSP&usercod={{usercod}}">{{rolescod}}</a></td>
        <td>{{roleuserest}}</td>
        <td>{{roleuserfch}}</td>
        <td>{{roleuserexp}}</td>
        <td>
          {{if ~edit_enabled}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="Mnt_Rolesusuario"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="usercod" value={{usercod}} />
              <button type="submit">Editar</button>
          </form>
          {{endif ~edit_enabled}}
          {{if ~delete_enabled}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="Mnt_Rolesusuario"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="usercod" value={{usercod}} />
              <button type="submit">Eliminar</button>
          </form>
          {{endif ~delete_enabled}}
        </td>
      </tr>
      {{endfor roles_usuarios}}
    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_Rolesusuario&mode=INS&usercod=0");
      });
    });
</script>
