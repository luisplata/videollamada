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
        margin: 8% auto; /* 15% from the top and centered */
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
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content" style="color: black">
        {!! Form::open(['url' => 'login']) !!}
        <div class="row uniform">
            <br/>                
            <div class="input-100">
                <label for="demo-name">Usuario</label>
                <input type="text" name="user" id="demo-name" value="" />
            </div>
            <div class="input-100">
                <label for="demo-email">Contraseña</label>
                <input type="password" name="pass" id="demo-email" value="" />
            </div>
            <div class="modal-botones">
                <ul class="actions botones">
                    <li><input type="submit" value="Ingresar" /></li>
                    <li><input type="reset" value="Cancelar" class="special" onclick="cerrarLoginModal()" /></li>
                </ul>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
    // Get the modal
    var loginmodal = document.getElementById('myModal');

// Get the button that opens the modal
    var btn_login = document.getElementById("btn-open-modal");

// When the user clicks on the button, open the modal 
    btn_login.onclick = function () {
        loginmodal.style.display = "block";
    }

// When the user clicks anywhere outside of the modal, close it
    function cerrarModalLogin(event) {
        if (event.target == loginmodal) {
            loginmodal.style.display = "none";
        }
    }
    function cerrarLoginModal() {
        loginmodal.style.display = "none";
    }
</script>