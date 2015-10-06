<?php
/**
 * Created by PhpStorm.
 * User: Oskar Klintrot
 * Date: 2015-10-05
 * Time: 10:20
 */

namespace controller;

require_once("model/RegistrationModel.php");
require_once("view/RegistrationView.php");

class RegistrationController
{
    private $model;
    private $view;

    public function __construct(\view\RegistrationView $view, \model\RegistrationModel $model) {
        $this->model = $model;
        $this->view =  $view;
    }

    public function userWantToRegister() {
        return $this->view->userWantToRegister();
    }

    public function userWantToRegisterNewUser() {
        return $this->view->userWantToRegisterNewUser();
    }

    public function doRegistration() {
        if($this->view->validate()){
            // Save user to db
        }
    }

}