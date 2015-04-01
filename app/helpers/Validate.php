<?php

/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 28/07/14
 * Time: 10:04
 */
class Validate
{
    private $passed = false;
    private $erros = array();
    /** @var DB */
    private $db = null;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $value = trim($source[$item]);
                $item = escape($item);

                if ($rule === 'required' && empty($value)) {
                    $this->addErro($item ,'é obrigatório');
                } elseif (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addErro($item, $rule_value);
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addErro($item, $rule_value);
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addErro($item, $rule_value);
                            }
                            break;
                        case 'email':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addErro($item, $rule_value);
                            }
                            break;
                        case 'unique':
                            $check = $this->db->get($rule_value, "{$item} = '{$value}'");
                            if ($check->getNumRegistros()) {
                                $this->addErro($item, $rule_value);
                            }
                            break;

                    }
                }

            }
        }

        if (empty($this->erros)) {
            $this->passed = true;
        }

        return $this;
    }

    public
    function addErro($item, $rule)
    {
        $this->erros[$item] = $rule;
    }

    public
    function erros()
    {
        return $this->erros;
    }

    public
    function passed()
    {
        return $this->passed;
    }

    public static function cssClass($field, array $erros)
    {
        if (Input::exists()) {
            if (in_array($field, $erros)) {
                return 'has-error';
            } else {
                return 'has-success';
            }
        }
        return '';
    }
}