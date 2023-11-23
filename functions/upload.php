<?php

function upload($file): string
{
    $formatosPermitidos = array("pdf", "doc", "docx");
    $extensao = pathinfo($file['name'], PATHINFO_EXTENSION);

    if (in_array($extensao, $formatosPermitidos)):
        $pasta = __DIR__ . "/../monografias/";
        $temporario = $file['tmp_name'];
        $novoNome = uniqid() . ".$extensao";

        if (move_uploaded_file($temporario, $pasta . $novoNome)):
            return $pasta . $novoNome;
        endif;
    endif;

    return '';
}