<h1>{{modedsc}}</h1>
<section class="row">
  <form action="index.php?page=Mnt_funcion&mode={{mode}}&fncod={{fncod}}"
    method="POST"
    class="col-6 col-3-offset"
  >
    <section class="row">
    <label for="fncod" >Código</label>
    <input type="text" id="fncod" name="fncod" value="{{fncod}}"/>
    <input type="hidden" id="mode" name="mode" value="{{mode}}"/>
    </section>

    <section class="row">
      <label for="fndsc" >Descripcion</label>
      <input type="text" {{readonly}} name="fndsc" value="{{fndsc}}" maxlength="45" />
    </section>

    <section class="row">
      <label for="fnest" >Estado</label>
      <select id="fnest" name="fnest" {{if readonly}}disabled{{endif readonly}}>
        <option value="ACT" {{fnest_ACT}}>Activo</option>
        <option value="INA" {{fnest_INA}}>Inactivo</option>
      </select>
    </section>


    <section class="row">
      <label for="fntyp" >Tipo</label>
      <select id="fntyp" name="fntyp" {{if readonly}}disabled{{endif readonly}}>
        <option value="ADM" {{fntyp_ADM}}>ADMIN</option>
        <option value="NOR" {{fntyp_NOR}}>NORMAL</option>
      </select>
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
  document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("btnCancelar").addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=Mnt_Funciones");
      });
  });
</script>