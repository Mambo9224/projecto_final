<?php

include 'core/init.php';

$utilizador = new User();

$utilizador->delete($_GET['id']);
Redirect::to('visualizar_utilizadores.php');