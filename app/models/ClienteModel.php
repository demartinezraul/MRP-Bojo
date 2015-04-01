<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 30/03/2015
 * Time: 00:37
 */

class ClienteModel extends Model
{
    /** @var  ClienteDTO */
    private $dto;
    /** @var  ClienteDAO */
    private $dao;

    /**
     *
     */
    public function __construct()
    {
        $this->dao = new ClienteDAO();
    }

    public function getArrayDados()
    {
        return array(
            'id_cliente' => $this->dto->getIdCliente(),
            'nome' => $this->dto->getNome(),
            'cpf' => $this->dto->getCpf(),
            'email' => $this->dto->getEmail(),
            'data_nascimento' => $this->dto->getDataNascimento()
        );
    }

    public function getCliente()
    {
        $_POST = filter_input_array(INPUT_POST);
        $nome = Input::get('nome');
        $pessoas = $this->dao->get("nome ilike '%{$nome}%' order by nome limit 5");

        $resultado = array();

        foreach ($pessoas as $pessoa) {
            $resultado[] = $this->setDTO($pessoa)->getBasicInfo();
        }

        return $resultado;
    }

    public function getBasicInfo()
    {
        $nascimento = (new DateTime($this->dto->getData_nascimento()))->format('d/m/Y');
        $converted =  str_replace('/','-',$nascimento);
        $date = new DateTime($converted); // data de nascimento
        $interval = $date->diff( new DateTime()); // data definida
        return array(
            'id' => $this->dto->getIdCliente(),
            'nome' => $this->dto->getNome(),
            'cpf' => $this->dto->getCpf(),
            'email' => $this->dto->getEmail(),
            'data_nascimento' => (new DateTime($this->dto->getData_nascimento()))->format('d/m/Y'),
        );
    }

    public function getDAO()
    {
        return $this->dao;
    }

    public function setDTO(ClienteDTO $dto)
    {
        $this->dto = $dto;
        return $this;
    }

    /**
     * @param RelacionadosDAO $relacionados
     * @return array|bool
     */

    public function existeCPF($cpf, $id)
    {
        $queryString = "cpf = '{$cpf}'";

        if ($id) {
            $queryString .= " AND id_cliente != {$id}";
        }

        $return = $this->dao->get($queryString);

        return (count($return) > 0 ? false : true);
    }

    public function existeEmail($email, $id)
    {
        $queryString = "email ilike '{$email}'";

        if ($id) {
            $queryString .= " AND id_cliente != {$id}";
        }

        $return = $this->dao->get($queryString);

        return (count($return) > 0 ? false : true);
    }

}