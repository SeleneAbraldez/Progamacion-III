<?php

    session_start();

    $_SESSION["usuario"] = "ok";
    //echo(var_dump($_SESSION));

    header('Location:index.php');
