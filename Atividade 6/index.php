<?php

/**
* Cria uma instância do controlador para uso
*/
include_once('app/controladores/Login.php');
$controller = new LoginController();

/**
* recebe uma requisição get e redireciona ela pra diferentes funções
*/
switch ($_GET['acao']) {
    case 'cadastrar':
        $controller->cadastrar();
        break;
    case 'info':
        $controller->info();
        break;
    case 'sair':
        $controller->sair();
        break;
    default:
        $controller->login();
}

?>