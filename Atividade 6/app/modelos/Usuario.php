<?php

/**
* ???? Descreva detalhadamente o que essa classe faz 
*/
class Usuario {

    /**
    * referencia ao tipo string
    * @var string
    */
    private $email;

    /**
    * referencia ao tipo string
    * @var string 
    */
    private $senha;

    /**
    * referencia ao tipo string
    * @var string 
    */
    private $nome;

    /**
    *  Construtor da classe, inicia as variaveis email, senha e nome
    */
    function __construct(string $email, string $senha, string $nome) {
        $this->email = $email;
        $this->senha = hash('sha256', $senha);
        $this->nome = $nome;
    }

    /**
    *  retormna um campo (nome, senha ou email)
    */
    public function __get($campo) {
        return $this->$campo;
    }

    /**
    *  atribui um valor a um campo
    */
    public function __set($campo, $valor) {
        return $this->$campo = $valor;
    }

    /**
    *  verifica se ha um conjunto [email, senha] igual ao passado pela função
    */
    public function igual(string $email, string $senha) {
        return $this->email === $email && $this->senha === hash('sha256', $senha);
    }
}

?>