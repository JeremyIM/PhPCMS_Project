<?php

require '../Business/UserClass.php';

//build new article business object
$userObj = UserClass::checkLoginInfo($_SESSION['login'], $_SESSION['pw']);




$newUser = new UserClass($_POST['uUsername']);
$newUser->setFistName($_POST['uFirstname']);
$newUser->setLastName($_POST['uLastname']);


$newUser->setWordpassSalt($newUser->generateSalt());
$newUser->setWordPass($newUser->generateHash($_POST['uWordpass'],$newUser->getWordPassSalt()));
$newUser->setCreatedBy($userObj->getId());

$result = $newUser->saveUser();

//report success/failure
echo $result;

?>