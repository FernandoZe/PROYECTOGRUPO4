<h1>{{mode_dsc}}</h1>
<section>
  
    <section>
      <label for="catid">Id Comic</label><br><br>
      <input type="number" {{readonly}}  name="id" value="{{comics_id}}" />      
      
    </section>
    <section>
      <label for="catid">Id Venta</label><br><br>
      <input type="number" {{readonly}}  name="id" value="{{venta_id}}" />      
    </section>    

    <section>
      <label for="catest">Cantidad</label><br><br>
      <input type="number" {{readonly}} name="cantidad" value="{{ventas_prod_cantidad}}" maxlength="45" placeholder="Cantidad" />

    </section>

    <section>
      <label for="catest">Precio</label><br><br>
      <input type="number" {{readonly}} name="precio" value="{{ventas_prod_precio_venta}}" maxlength="45" placeholder="Precio" />

    </section>
    {{if hasErrors}}
    <section>
      <ul>
        {{foreach aErrors}}
        <li>{{this}}</li>
        {{endfor aErrors}}
      </ul>
    </section>
    {{endif hasErrors}}
    <section>
      {{if show_action}}
      <button type="submit" name="btnGuardar" value="G">Guardar</button>
      {{endif show_action}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </section>
  
</section>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnCancelar").addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=mnt_ventas");
    });
  });
</script>