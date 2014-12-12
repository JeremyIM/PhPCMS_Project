<?php

require '../Business/UserClass.php';
$userObj = UserClass::checkLoginInfo($_SESSION['login']);

//build new article business object
$newUser = new UserClass(strip_tags( trim($_POST['uUsername'])));
$newUser->setFistName(strip_tags( trim($_POST['uFirstname'])));
$newUser->setLastName(strip_tags( trim($_POST['uLastname'])));

$newUser->setWordpassSalt($newUser->generateSalt());
$newUser->setWordPass($newUser->generateHash($_POST['uWordpass'],$newUser->getWordPassSalt()));

$newUser->setCreatedBy($userObj->getId());

$result = $newUser->saveUser();

//report success/failure
echo $result;

?>