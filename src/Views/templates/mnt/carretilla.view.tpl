<h1>{{modedsc}}</h1>
<section class="row">
  <form action="index.php?page=Mnt_Carretilla&mode={{mode}}&usercod={{usercod}}" method="POST" class="col-6 col-3-offset">
     <section class="row">
      <label for="usercod" class="col-4">Código Usuario</label>
      <input type="hidden" id="usercod" name="usercod" value="{{usercod}}" />
      <input type="hidden" id="mode" name="mode" value="{{mode}}" />
      <input type="hidden" name="xssToken" value="{{xssToken}}" />
      <input type="text" readonly name="usercoddummy" value="{{usercod}}" />
    </section>

    
    
   <section class="row">
      <label for="PrdId" class="col-4">Producto ID</label>
      <input type="text" {{readonly}} name="PrdId" value="{{PrdId}}" maxlength="45"/>
   
    </section>

    <section class="row">
      <label for="PrdName" class="col-4">Producto Nombre</label>
      <input type="text" {{readonly}} name="PrdName" value="{{PrdName}}" maxlength="45" />
   
    </section>

    <section class="row">
      <label for="PrdPrecio" class="col-4">Precio</label>
      <input type="text" {{readonly}} name="PrdPrecio" value="{{PrdPrecio}}" maxlength="45"/>

    </section>


    <section class="row">
      <label for="cantidad" class="col-4">cantidad</label>
      <input type="text" {{readonly}} name="cantidad" value="{{cantidad}}" maxlength="45" />
    
    </section>
    <section class="row">
      <label for="total" class="col-4">total</label>
      <input type="text" {{readonly}} name="total" value="{{total}}" maxlength="45" />
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
      window.location.assign("index.php?page=Mnt_Carretillas");
    });
  });
</script>