<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-05
 * Time: 14:39
 */

namespace controller;

//App specific
require_once("view/DateTimeView.php");
require_once("view/LayoutView.php");

//Login
require_once("controller/LoginController.php");
require_once("view/LoginView.php");

//Registration
require_once("controller/RegistrationController.php");
require_once("view/RegistrationView.php");

class MasterController
{
    private $m_Login;
    private $v_Login;
    private $c_Login;
    private $m_Registration;
    private $v_Registration;
    private $c_Registration;

    public function run() {
        //Dependency injection
        $m_Login = new \model\LoginModel();
        $v_Login = new \view\LoginView($m_Login);
        $c_Login = new \controller\LoginController($m_Login, $v_Login);

        $m_Registration = new \model\RegistrationModel();
        $v_Registration = new \view\RegistrationView($m_Registration);
        $c_Registration = new \controller\RegistrationController($v_Registration, $m_Registration);

        //Controller must be run first since state is changed
        $c_Login->doControl();
        $c_Registration->doRegistration();

        //Generate output
        $dtv = new \view\DateTimeView();
        $lv = new \view\LayoutView();
        $lv->render($m_Login->isLoggedIn($v_Login->getUserClient()), $v_Login, $dtv);
    }
}