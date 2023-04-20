<h1>{{modedsc}}</h1>
<section class="row">
  <form action="index.php?page=Mnt_Producto&mode={{mode}}&PrdId={{PrdId}}" method="POST" class="col-6 col-3-offset">
    <section class="row">
      <label for="PrdId" class="col-4">Código</label>
      <input type="hidden" id="PrdId" name="PrdId" value="{{PrdId}}" />
      <input type="hidden" id="mode" name="mode" value="{{mode}}" />
      <input type="hidden" name="xssToken" value="{{xssToken}}" />
      <input type="text" readonly name="PrdIddummy" value="{{PrdId}}" />
    </section>

    <section class="row">
      <label for="catid" class="col-4">Categoria</label>
      <input type="text" {{readonly}} name="catid" value="{{catid}}" maxlength="45" placeholder="Categoria" />
    
    </section>

    <section class="row">
      <label for="PrdName" class="col-4">Producto</label>
      <input type="text" {{readonly}} name="PrdName" value="{{PrdName}}" maxlength="45"
        placeholder="Nombre de Producto" />
   
    </section>

    <section class="row">
      <label for="PrdPrecio" class="col-4">Precio</label>
      <input type="text" {{readonly}} name="PrdPrecio" value="{{PrdPrecio}}" maxlength="45" placeholder="Precio" />

    </section>



    <section class="row">
      <label for="cantidad" class="col-4">cantidad</label>
      <input type="text" {{readonly}} name="cantidad" value="{{cantidad}}" maxlength="45"
        placeholder="Cantidad" />
    
    </section>

    <section class="row">
      <label for="img" class="col-4">img</label>
      <input type="file" {{readonly}} name="img" value="{{img}}" maxlength="45"/>
    
  
    </section>



    {{if has_errors}}
    <section>
      <ul>
        {{foreach general_errors}}
        <li>{{this}}</li>
        {{endfor general_errors}}
      </ul>
    </section>
    {{endif has_errors}}
    <section>
      {{if show_action}}
      <button type="submit" name="btnGuardar" value="G">Guardar</button>
      {{endif show_action}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </section>
  </form>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnCancelar").addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=Mnt_Productos");
    });
  });
</script>