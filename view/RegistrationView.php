<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-05
 * Time: 12:24
 */

namespace view;

require_once("model/RegistrationModel.php");

class RegistrationView
{
    private $model;

    public function __construct(\model\RegistrationModel $model) {
        $this->model = $model;
    }

}