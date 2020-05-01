<?php

/**
* ???? Descreva detalhadamente o que essa classe faz ????
*/
class Usuario {

    /**
    * ?????
    * @var string ????
    */
    private $email;

    /**
    * ?????
    * @var string ????
    */
    private $senha;

    /**
    * ?????
    * @var string ????
    */
    private $nome;

    /**
    *  ???? Descreva detalhadamente o que esse método faz ????
    */
    function __construct(string $email, string $senha, string $nome) {
        $this->email = $email;
        $this->senha = hash('sha256', $senha);
        $this->nome = $nome;
    }

    /**
    *  ???? Descreva detalhadamente o que esse método faz ????
    */
    public function __get($campo) {
        return $this->$campo;
    }

    /**
    *  ???? Descreva detalhadamente o que esse método faz ????
    */
    public function __set($campo, $valor) {
        return $this->$campo = $valor;
    }

    /**
    *  ???? Descreva detalhadamente o que esse método faz ????
    */
    public function igual(string $email, string $senha) {
        return $this->email === $email && $this->senha === hash('sha256', $senha);
    }
}

?>