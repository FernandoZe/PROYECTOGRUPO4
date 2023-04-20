<h1>Gestión de Ventas</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>id Comic</th>
        <th>id Venta</th>
        <th>Cantidad</th>
        <th>Precio</th>       
      </tr>
    </thead>
    <tbody>
      {{foreach Ventas}}
      <tr>        
        <td>
          <center>

          <a href="index.php?page=mnt_venta&mode=DSP&comics_id={{comics_id}}&venta_id={{venta_id}}">{{comics_id}}</a>
          </center>
          </td>
        <td>
          <center>

          <a href="index.php?page=mnt_venta&mode=DSP&comics_id={{comics_id}}&venta_id={{venta_id}}">{{venta_id}}</a>
          </center>
          </td>
        <td>
          <center>
          {{ventas_prod_cantidad}}
          </center>
        </td>
       
       <td>
          <center>
          {{ventas_prod_precio_venta}}
          </center>
        </td>
      </tr>
      {{endfor Ventas}}
    </tbody>
  </table>
</section>


