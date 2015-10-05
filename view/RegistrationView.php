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

	private static $fontSize = 20;
	private static $message = "RegisterView::Message";
	private static $username = "RegisterView::UserName";
	private static $password = "RegisterView::Password";
	private static $passwordRepeat = "RegisterView::PasswordRepeat";
	private static $submitForm = "submit";
	private static $doRegistrationForm = "DoRegistration";
	private static $registerForm = "Register";

    public function __construct(\model\RegistrationModel $model) {
        $this->model = $model;
    }

    public function userWantToRegister(){
		if(strpos(@parse_url($_SERVER['REQUEST_URI'])['query'], $this->register) !== false)
			return true;
		else
			return false;
    }

    public function response() {
        return "<form action='?register' method='post' enctype='multipart/form-data'>
				<fieldset>
				<legend>Register a new user - Write username and password</legend>
					<p id='".self::$message."'></p>
					<label for='".self::$username."'>Username :</label>
					<input type='text' size='".self::$fontSize."' name='".self::$username."' id='".self::$username."' value=''>
					<br>
					<label for='".self::$password."'>Password  :</label>
					<input type='password' size='".self::$fontSize."' name='".self::$password."' id='".self::$password."' value=''>
					<br>
					<label for='".self::$passwordRepeat."'>Repeat password  :</label>
					<input type='password' size='".self::$fontSize."' name='".self::$passwordRepeat."' id='".self::$passwordRepeat."' value=''>
					<br>
					<input id='".self::$submitForm."' type='submit' name='".self::$doRegistrationForm."' value='".self::$registerForm."'>
					<br>
				</fieldset>
			</form>";
    }
}