<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-05
 * Time: 12:24
 */

namespace view;

require_once("iLayoutView.php");
require_once("model/RegistrationModel.php");

class RegistrationView implements iLayoutView
{
    private $model;
    private $register = "register";

    private static $RegisterNewUser = "RegistrationView::RegisterNew";

    public function __construct(\model\RegistrationModel $model) {
        $this->model = $model;
    }

    public function userWantToRegister(){
        return @parse_url($_SERVER['REQUEST_URI'])['query'] == $this->register;
    }

    public function response() {

    }
}