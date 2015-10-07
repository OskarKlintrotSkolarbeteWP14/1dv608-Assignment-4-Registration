<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-05
 * Time: 14:39
 */

namespace controller;

//App specific
use view\RegistrationView;

require_once("view/DateTimeView.php");
require_once("view/LayoutView.php");

//Login
require_once("controller/LoginController.php");
require_once("view/LoginView.php");

//Registration
require_once("controller/RegistrationController.php");
require_once("view/RegistrationView.php");
require_once("model/RegistrationDAL.php");

class MasterController
{
    private $m_Login;
    private $v_Login;
    private $c_Login;
    private $m_Registration;
    private $m_RegistrationDAL;
    private $v_Registration;
    private $c_Registration;
    private $loggedIn = false;
    private $registerNewUser = false;

    public function run() {
        //Dependency injection
        $m_Login = new \model\LoginModel();
        $v_Login = new \view\LoginView($m_Login);
        $c_Login = new \controller\LoginController($m_Login, $v_Login);

        $m_Registration = new \model\RegistrationModel();
        $m_RegistrationDAL = new \model\RegistrationDAL();
        $v_Registration = new \view\RegistrationView($m_Registration);
        $c_Registration = new \controller\RegistrationController($v_Registration, $m_Registration, $m_RegistrationDAL);

        //Controller must be run first since state is changed
        if($c_Registration->userWantToRegister()) {
            $viewToRender = $v_Registration;
            $this->registerNewUser = true;
            if($c_Registration->userWantToRegisterNewUser()) {
                $c_Registration->doRegistration();
            }
        }
        else {
            $viewToRender = $v_Login;
            $c_Login->doControl();
            $this->loggedIn = $m_Login->isLoggedIn($v_Login->getUserClient());
        }

        //Generate output
        $v_DateTime = new \view\DateTimeView();
        $v_Layout = new \view\LayoutView();
        $v_Layout->render($this->registerNewUser, $this->loggedIn, $viewToRender, $v_DateTime);
    }
}