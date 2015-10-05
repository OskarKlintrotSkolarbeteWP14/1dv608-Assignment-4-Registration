<?php
 /**
  * Solution for assignment 2
  * @author Daniel Toll
  */
require_once("Settings.php");

//Login
require_once("controller/LoginController.php");
require_once("view/DateTimeView.php");
require_once("view/LayoutView.php");

//Registration
require_once("controller/RegistrationController.php");
require_once("view/RegistrationView.php");

if (Settings::DISPLAY_ERRORS) {
	error_reporting(-1);
	ini_set('display_errors', 'ON');
}

//session must be started before LoginModel is created
session_start(); 

//Dependency injection
$m_Login = new \model\LoginModel();
$v_Login = new \view\LoginView($m_Login);
$c_Login = new \controller\LoginController($m_Login, $v_Login);

$m_Registration = new \model\RegistrationModel();
$v_Registration = new \view\RegistrationView($m_Registration);
$c_Registration = new \controller\RegistrationController($v_Registration, $m_Registration);


//Controller must be run first since state is changed
$c_Login->doControl();


//Generate output
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView();
$lv->render($m_Login->isLoggedIn($v_Login->getUserClient()), $v_Login, $dtv);

