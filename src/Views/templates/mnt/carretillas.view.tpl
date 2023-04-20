<style>
.btn-pagar {
  display: inline-block;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background-color: #3498db;
  color: #fff;
  font-size: 16px;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

</style>


<h1>Gestión de Carrito
</h1>
 <center><a href="http://localhost/mvc_nw_202301-MAIN/index.php?page=checkout-checkout" class="btn-pagar">PAGAR</a></center>
 <br>
<section class="WWFilter">






</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>User Codigo</th>
        <th>Producto Id</th>
        <th>Nombre Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Total</th>
        <th>
          {{if new_enabled}}
          <button id="btnAdd">Nuevo</button>
          {{endif new_enabled}}
        </th>
      </tr>
    </thead>
    <tbody>
      {{foreach Carretillas}}
      <tr>
        <td>{{usercod}}</td>
        <td><a href="index.php?page=Mnt_carretilla&mode=DSP&usercod={{usercod}}">{{PrdId}}</a></td>
        <td>{{PrdName}}</td>
        <td>{{PrdPrecio}}</td>
        <td>{{cantidad}}</td>
        <td>{{total}}</td>
        <td>
          {{if ~edit_enabled}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="Mnt_Carretilla" />
            <input type="hidden" name="mode" value="UPD" />
            <input type="hidden" name="usercod" value={{usercod}} />
            <button type="submit">Editar</button>
          </form>
          {{endif ~edit_enabled}}
          {{if ~delete_enabled}}
          <form action="index.php" method="get">
            <input type="hidden" name="page" value="Mnt_Carretilla" />
            <input type="hidden" name="mode" value="DEL" />
            <input type="hidden" name="usercod" value={{usercod}} />
            <button type="submit">Eliminar</button>
          </form>
          {{endif ~delete_enabled}}
        </td>
      </tr>
      {{endfor Carretillas}}
    </tbody>
  </table>
</section>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnAdd").addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=mnt_carretilla&mode=INS&usercod=0");
    });
  });
</script>