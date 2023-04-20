<h1>Gestión de Inventarios</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>Código</th>
        <th>Codigo Categoria</th>
        <th>Codigo Producto</th>
        <th>Existencias</th>
        <th>Fecha</th>
        <th>
          <a href="index.php?page=Mnt_Inventario&mode=INS">Nuevo</a>
        </th>
      </tr>
    </thead>
    <tbody>
      {{foreach Inventarios}}
      <tr>
        <td>{{invId}}</td>
        <td>
          <a href="index.php?page=Mnt_Inventario&mode=DSP&invId={{invId}}">{{invCategoriaCod}}</a>
        </td>
        <td>{{invPrdCod}}</td>
        <td>{{existencias}}</td>
        <td>{{fecha}}</td>
        <td>
          <a href="index.php?page=Mnt_Inventario&mode=UPD&invId={{invId}}">Editar</a>&nbsp;<a href="index.php?page=Mnt_Inventario&mode=DEL&invId={{invId}}">Eliminar</a>
        </td>
      </tr>
      {{endfor Inventarios}}
    </tbody>
  </table>
</section>