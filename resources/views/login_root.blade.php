<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        {!! Form::open(['url' => 'login_root']) !!}
        <input name="user" placeholder="Usuario">
        <br/>
        <input name="pass" placeholder="Contraseña" type="password">
        <br/>
        <button type="submit">Ingresar</button>
        {!! Form::close() !!}
    </body>
</html>
