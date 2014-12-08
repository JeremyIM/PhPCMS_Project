<?php

require '../Business/UserClass.php';

//build new article business object

$userObj = UserClass::checkLoginInfo($_SESSION['login'], $_SESSION['pw']);

$newUser = new UserClass($_POST['uUsername']);
$newUser->setId($_POST['editUserId']);
$newUser->setUsername($_POST['uUsername']);
$newUser->setFistName($_POST['uFirstname']);
$newUser->setLastName($_POST['uLastname']);
$newUser->setModifier($userObj->getId());
$newUser->setWordPass($_POST['uWordpass']);
$result = $newUser->updateUser();

//report success/failure
echo $result;

?>