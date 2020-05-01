<?php 

require 'app/modelos/Usuario.php';
require 'Controlador.php';

/**
* responsavel por controlar loguin
*/
class LoginController extends Controller  {
    
    /**
    * referencia ao modelo Usuario
    * @var Usuario
    */
    private $loggedUser;
    
    /**
    * construtor da classe
    *  inicia a sessão e atribui o loggedUser ao campo user da sessssão
    */
    function __construct() {
        session_start();
        if (isset($_SESSION['user'])) $this->loggedUser = $_SESSION['user'];
    }
    
    /**
    * função que lida com o loguin
    * caso a requisição seja do tipo post e se o usuarios estiver setado na sessão 
    * percorre todos os usuários reguistrados e caso encontre uma correlação [email, selha] passados com [email, senha] de um usuário registrado
    * efetua o loguin passando o usuario da sessão para o loggedUser
    * caso não ache correlações [email, senha]:
    * envia informações e mensagem de erro
    * caso a requisição não seja do tipo post 
    * redireciona para a view de login
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
    * caso a requisição seja do tipo post e o campo users não esteja setado
    * seta users como um vetor
    * verifica se ja existe o email a ser cadastrado, caso exista emite uma mensagem de erro
    * caso o email seja unico 
    * adiciona novo usuario a lista de usuarios
    * manda mensagem de sucesso
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
    * ao ser chama essa função verifica pela pela variavel loggedUser
    * caso ela esteja vasia emite um alerta dezendo que deve ser feito o login antes de receber informações
    * caso o usuario esteja logado ele é redirecionado para a pag de informações passando as informações de qual usuario está logado
    */
    public function info() {
        if (!$this->loggedUser) {
            header('Location: index.php?acao=entrar&mensagem=Você precisa se identificar primeiro');    
            return;
        }
        $this->view('users/info', $this->loggedUser);        
    }

    /**
    * ao ser chama essa função verifica pela pela variavel loggedUser
    * caso ela esteja vasia emite um alerta dezendo que deve ser feito o login antes de sair
    * caso o usuario esteja logado é apagado da sessão o usuario que está logado
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