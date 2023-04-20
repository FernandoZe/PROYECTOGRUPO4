<style>
.btn-carrito {
  display: inline-block;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background-color: #f39c12;
  color: #fff;
  font-size: 16px;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

</style>

<h1>Tienda Online</h1>
<section class="WWFilter">

         


</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Imagen</th>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>
          {{if productos_new}}
          <button id="btnAdd">Nuevo</button>
          {{endif productos_new}}
        </th>
      </tr>
    </thead>
    <tbody>
      {{foreach productos}}
      <tr>
     <td><img src="public/imgs/{{img}}" alt="" width="300" height="150"></td>
        <td><a href="index.php?page=Mnt_Producto&mode=DSP&PrdId={{PrdId}}">{{PrdName}}</a></td>
        <td>{{PrdPrecio}}</td>
        <td>{{cantidad}}</td>
      
        <td>
          {{if ~productos_edit}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="Mnt_Producto"/>
              <input type="hidden" name="mode" value="UPD" />
              <input type="hidden" name="PrdId" value={{PrdId}} />
              <button type="submit">Editar</button>
          </form>
          {{endif ~productos_edit}}
          {{if ~productos_delete}}
          <form action="index.php" method="get">
             <input type="hidden" name="page" value="Mnt_Producto"/>
              <input type="hidden" name="mode" value="DEL" />
              <input type="hidden" name="PrdId" value={{PrdId}} />
              <button type="submit">Eliminar</button>
          </form>
          {{endif ~productos_delete}}
        </td>
        <td><a href="index.php?page=Mnt_Carretillas" class="btn-carrito">CARRITO</a></td>
      </tr>
      {{endfor productos}}
    </tbody>
  </table>
</section>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_producto&mode=INS&PrdId=0");
      });
    });
</script>
