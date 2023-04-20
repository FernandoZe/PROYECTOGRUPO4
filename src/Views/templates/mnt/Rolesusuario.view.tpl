<h1>{{modedsc}}</h1>
<section class="row">
    <form action="index.php?page=Mnt_Rolesusuario&mode={{mode}}&usercod={{usercod}}" method="POST"
        class="col-6 col-3-offset">
        <section class="row">
            <label for="usercod" class="col-4">Código</label>
            <input type="hidden" id="usercod" name="usercod" value="{{usercod}}" />
            <input type="hidden" id="mode" name="mode" value="{{mode}}" />
            <input type="hidden"  name="xssToken" value="{{xssToken}}"/>
            <input type="text"  name="usercoddummy" value="{{usercod}}" />
        </section>

        <section class="row">
            <label for="roleuserfch" class="col-4">Fecha</label>
            <input type="date" {{readonly}} name="roleuserfch" value="{{roleuserfch}}" />
        </section>

        <section class="row">
            <label for="roleuserest" class="col-4">Estado</label>
            <select id="roleuserest" name="roleuserest" {{if readonly}}disabled{{endif readonly}}>
                <option value="ACT" {{roleuserest_ACT}}>ACTIVO</option>
                <option value="INA" {{roleuserest_INA}}>INACtivo</option>
            </select>
        </section>



        <section class="row">
            <label for="rolescod" class="col-4">Roles Codigo</label>
            <input type="text" {{readonly}} name="rolescod" value="{{rolescod}}" maxlength="45" />
        </section>

          <section class="row">
            <label for="roleuserexp" class="col-4">Fecha Expira</label>
            <input type="date" {{readonly}} name="roleuserexp" value="{{roleuserexp}}" />
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
            window.location.assign("index.php?page=Mnt_Rolesusuarios");
        });
    });
</script>