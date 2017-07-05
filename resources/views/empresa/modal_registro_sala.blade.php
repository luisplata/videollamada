<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        /*background-color: #fefefe;*/
        background: #4c5c96;
        margin: 5% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .modal-close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .modal-1close:hover,
    .modal-close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .input-100{
        width: 100%;
    }
    .modal-botones{
        float: right;
    }

    input{
        color: black;
        }
    .ui-datepicker {
        background-color: rgb(0,0,0); /* Fallback color */
       
    }

</style>
<div id="registro_sala" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="color: black">
        {!! Form::open(['url' => 'empresa/sala/registro']) !!}
        <br/>
        <input type="hidden" value="{{Session::get('empresa')->id}}" name="empresa_id">
        <input type="hidden" value="{{Session::get('empresa')->token}}" name="empresa_token">
        
        
        <div class="field">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" required class="input-100"  />
        </div>
        <div class="field">
            <label for="hora_inicio">Hora de Inicio</label>
            <input  type="time" name="hora_inicio" id="hora_inicio" required class="input-100" placeholder="00:00"/>
        </div>
        <div class="field">
            <label for="hora_fin">Hora de Fin</label>
            <input  type="time" name="hora_fin" id="hora_fin" required class="input-100" placeholder="00:00"/>
        </div>
        
        <ul class="actions">
            <li><input type="submit" value="Crear Sala" /></li>
            <li><input type="reset" value="Cancelar" class="special" onclick="cerrarModalSala()" /></li>
        </ul>
        {!! Form::close() !!}
    </div>

</div>




<script>
    // Get the modal
    var modal_sala = document.getElementById('registro_sala');

    // Get the button that opens the modal
    var btn_sala = document.getElementById("crear_sala");

    // When the user clicks on the button, open the modal 
    btn_sala.onclick = function () {
        modal_sala.style.display = "block";
    }

    // When the user clicks anywhere outside of the modal, close it
    function cerrarModalSalaOut(event) {
        if (event.target == modal_sala) {
            modal_sala.style.display = "none";
        }
    }

    function cerrarModalSala() {
        modal_sala.style.display = "none";
    }
</script>

  <script>
    


$(document).ready(function(){

        $( "#fecha" ).datepicker({
                dateFormat: 'yy-mm-dd'
            });

        

});



   
 
  </script>