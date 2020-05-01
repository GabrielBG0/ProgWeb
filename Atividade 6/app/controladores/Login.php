<?php 

require 'app/modelos/Usuario.php';
require 'Controlador.php';

/**
* ???? Descreva detalhadamente o que essa classe faz ????
*/
class LoginController extends Controller  {
    
    /**
    * ?????
    * @var Usuario ????
    */
    private $loggedUser;
    
    /**
    *  ???? Descreva detalhadamente o que esse método faz ????
    */
    function __construct() {
        session_start();
        if (isset($_SESSION['user'])) $this->loggedUser = $_SESSION['user'];
    }
    
    /**
    *  ???? Descreva detalhadamente o que esse método faz ????
    */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['users'])) {
                foreach ($_SESSION['users'] as $user) {
                    if ($user->igual($_POST['email'], $_POST['senha'])) {
                        $_SESSION['user'] = $this->loggedUser = $user;
                        break;
                    }
                }
            }

            if ($this->loggedUser) {
                header('Location: index.php?acao=info');
            } else {
                header('Location: index.php?email=' . $_POST['email'] . '&mensagem=Usuário e/ou senha incorreta!');
            }
        } else {
            if (!$this->loggedUser) {
                $this->view('users/login');
            } else {
                header('Location: index.php?acao=info');
            }
        }
    }

    /**
    *  ???? Descreva detalhadamente o que esse método faz ????
    */
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['users'])) $_SESSION['users'] = array();
            
            foreach ($_SESSION['users'] as $user) {
                if ($user->email == $_POST['email']) {
                    header('Location: index.php?acao=cadastrar&mensagem=Email já cadastrado!');
                    return;
                }
            }
            
            $user = new Usuario($_POST['email'], $_POST['senha'], $_POST['nome']);
            array_push($_SESSION['users'], $user);
            
            header('Location: index.php?email=' . $_POST['email'] . '&mensagem=Usuário cadastrado com sucesso!');
            return;
        }
        $this->view('users/cadastrar');
    }

    /**
    *  ???? Descreva detalhadamente o que esse método faz ????
    */
    public function info() {
        if (!$this->loggedUser) {
            header('Location: index.php?acao=entrar&mensagem=Você precisa se identificar primeiro');    
            return;
        }
        $this->view('users/info', $this->loggedUser);        
    }

    /**
    *  ???? Descreva detalhadamente o que esse método faz ????
    */
    public function sair() {
        if (!$this->loggedUser) {
            header('Location: index.php?acao=entrar&mensagem=Você precisa se identificar primeiro');
            return;
        }
        unset($_SESSION['user']);
        header('Location: index.php?mensagem=Usuário deslogado com sucesso!');
    }
}

?>