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
</style>
<div id="registro" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="color: black">
        {!! Form::open(['url' => 'empresa/registro']) !!}
        <br/>
        <div class="field">
            <label for="name">Nombre</label>
            <input type="text" name="nombre" id="name" required />
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required />
        </div>
        <div class="field">
            <label for="telefono">Telefono</label>
            <input type="tel" name="telefono" id="telefono" />
        </div>
        <div class="field">
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" id="pass" required />
        </div>
        <ul class="actions">
            <li><input type="submit" value="Send Message" /></li>
            <li><input type="reset" value="Cancelar" class="special" onclick="cerrarModal()" /></li>
        </ul>
        {!! Form::close() !!}
    </div>

</div>
<script>
    // Get the modal
    var modal = document.getElementById('registro');

    // Get the button that opens the modal
    var btn = document.getElementById("btn-registro");

    // When the user clicks on the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks anywhere outside of the modal, close it
    function cerrarModalRegistro(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function cerrarModal() {
        modal.style.display = "none";
    }
</script>