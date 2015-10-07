<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-05
 * Time: 12:23
 */

namespace model;

require_once("User.php");

class RegistrationDAL
{
    private $DatabaseConnection;

    public function __construct(DatabaseConnection $databaseConnection) {
        $this->DatabaseConnection = $databaseConnection;
    }

    public function SaveUser(User $user) {

        return true;
    }

}