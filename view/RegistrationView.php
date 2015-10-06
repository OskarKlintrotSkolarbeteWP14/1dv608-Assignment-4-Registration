<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-05
 * Time: 12:24
 */

namespace view;

use exception\InvalidPasswordException;
use exception\InvalidUsernameException;
use exception\ToShortPasswordException;
use exception\ToShortUsernameException;

require_once("iLayoutView.php");
require_once("model/RegistrationModel.php");
require_once("model/ValidateUser.php");

class RegistrationView implements iLayoutView
{
    private $model;
    private $register = "register";

	private static $fontSize = 20;
	private static $messageForm = "RegisterView::Message";
	private static $username = "RegisterView::UserName";
	private static $password = "RegisterView::Password";
	private static $passwordRepeat = "RegisterView::PasswordRepeat";
	private static $submitForm = "submit";
	private static $doRegistrationForm = "DoRegistration";
	private static $registerForm = "Register";

	private $message = [];

    public function __construct(\model\RegistrationModel $model) {
        $this->model = $model;
    }

    public function userWantToRegister(){
		if(strpos(@parse_url($_SERVER['REQUEST_URI'])['query'], $this->register) !== false)
			return true;
		else
			return false;
    }

	public function userWantToRegisterNewUser(){
		return isset($_POST[self::$doRegistrationForm]);
	}

	public function getUsername(){
		if(isset($_POST[self::$username]))
			return $_POST[self::$username];
		else
			return '';
	}

	private function getPassword(){
		if(isset($_POST[self::$password]))
			return $_POST[self::$password];
		else
			return '';
	}

	private function getPasswordRepeat(){
		if(isset($_POST[self::$passwordRepeat]))
			return $_POST[self::$passwordRepeat];
		else
			return '';
	}

	public function validate() {
		unset($this->message);
		$this->message = array() ;

		$username = $this->getUsername();
		$password = $this->getPassword();
		$repeatedPassword = $this->getPasswordRepeat();

		$validateUser = new \model\ValidateUser($username, $password);

		try {
			$validateUser->testValidUsername();
		} catch (InvalidUsernameException $e) {
			$this->message[] = "Username contains invalid characters.";
		} catch (\Exception $e) {
			$this->message[] = $e;
		}

		try {
			$validateUser->testValidPassword();
		} catch (InvalidPasswordException $e) {
			$this->message[] = "Password contains invalid characters.";
		} catch (\Exception $e) {
			$this->message[] = $e;
		}

		try {
			$validateUser->testUsernameLength();
		} catch (ToShortUsernameException $e) {
			$this->message[] = "Username has too few characters, at least 3 characters.";
		} catch (\Exception $e) {
			$this->message[] = $e;
		}

		try {
			$validateUser->testPasswordLength();
		} catch (ToShortPasswordException $e) {
			$this->message[] = "Password has too few characters, at least 6 characters.";
		} catch (\Exception $e) {
			$this->message[] = $e;
		}

		if ($password != $repeatedPassword) {
			$this->message[] = "Passwords do not match.";
		}

		if (empty($this->message))
			return true;
		else
			return false;
	}

	private function renderMessages($messages){
		$splitMessages = "";
		$divider = "<br />";
		foreach($messages as $message) {
			$splitMessages .= $message . $divider;
		}
		return substr($splitMessages, 0, -strlen($divider));
	}

    public function response() {
        return "<form action='?register' method='post' enctype='multipart/form-data'>
				<fieldset>
				<legend>Register a new user - Write username and password</legend>
					<p id='".self::$messageForm."'>".$this->renderMessages($this->message)."</p>
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