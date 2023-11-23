<?php

include 'core/init.php';

$monografia = new Monografia();

$monografia->delete($_GET['id']);
Redirect::to('visualizar_monografias.php');