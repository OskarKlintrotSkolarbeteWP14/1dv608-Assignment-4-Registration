<?php
/**
  * Solution for assignment 2
  * @author Daniel Toll
  */
namespace model;

require_once("ValidateUser.php");

class UserCredentials {

	private $userName;
	private $password;
	private $tempPassword;
	private $client;
	
	public function __construct($name, $password, $tempPassword, UserClient $client) {
//		$newUsername =  htmlspecialchars($name);
//		$newPassword = htmlspecialchars($password);
		$newUsername =  $name;
		$newPassword = $password;

		$userToValidate = new ValidateUser($newUsername, $newPassword);
		$userToValidate->runTests();

		$this->userName = $newUsername ;
		$this->password = $newPassword;
		$this->tempPassword = $tempPassword;
		$this->client = $client;
	}

	public function getName() {
		return $this->userName;
	}
	public function getPassword() {
		return $this->password;
	}
	public function getTempPassword() {
		return $this->tempPassword;
	}

	public function getClient()  {
		return $this->client;
	}
}