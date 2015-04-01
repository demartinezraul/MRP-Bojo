<?php
/**
 * Created by PhpStorm.
 * User: Raul
 * Date: 29/03/2015
 * Time: 21:26
 */

abstract class Controller
{
    /** @var  DataAccessObject */
    protected $model;
    /** @var  View */
    protected $view;
    protected $dados;

    protected function setModel(DataAccessObject $model)
    {
        $this->model = $model;
    }

    protected function getModel()
    {
        return $this->model;
    }

}