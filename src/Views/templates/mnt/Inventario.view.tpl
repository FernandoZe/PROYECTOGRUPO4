<h1>{{modedsc}}</h1>
<section class="row">
    <form action="index.php?page=Mnt_Inventario&mode={{mode}}&invId={{invId}}" method="POST" class="col-6 col-3-offset">
        <section class="row">
            <label for="invId" class="col-4">Código</label>
            <input type="hidden" id="invId" name="invId" value="{{invId}}" />
            <input type="hidden" id="mode" name="mode" value="{{mode}}" />
            <input type="hidden" name="xssToken" value="{{xssToken}}" />
            <input type="text" readonly name="invIddummy" value="{{invId}}" />
        </section>



        <section class="row">
            <label for="invCategoriaCod" class="col-4">Codigo Categoria</label>
            <input type="text" {{readonly}} name="invCategoriaCod" value="{{invCategoriaCod}}" maxlength="45" />
        </section>

        <section class="row">
            <label for="invPrdCod" class="col-4">Codigo Producto</label>
            <input type="text" {{readonly}} name="invPrdCod" value="{{invPrdCod}}" maxlength="45" />
        </section>

             <section class="row">
            <label for="existencias" class="col-4">existencias</label>
            <input type="text" {{readonly}} name="existencias" value="{{existencias}}" maxlength="45" />
        </section>



        <section class="row">
            <label for="fecha" class="col-4">Fecha</label>
            <input type="date" {{readonly}} name="fecha" value="{{fecha}}" />
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
            window.location.assign("index.php?page=Mnt_Inventarios");
        });
    });
</script>