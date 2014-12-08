<?php
require '../Business/UserClass.php';
require '../Business/UserClass.php';
$userObj = UserClass::checkLoginInfo($_SESSION['login'], $_SESSION['pw']);

//build new article business object
$newUser = new UserClass($_POST['uUsername']);
$newUser->setId($_POST['editUserId']);
$newUser->setUsername($_POST['uUsername']);
$newUser->setFistName($_POST['uFirstname']);
$newUser->setLastName($_POST['uLastname']);
$newUser->setWordPass($_POST['uWordpass']);
$newUser->setModifier($userObj->getId());

$result = $newUser->updateUser();
//report success/failure
echo $result;
?>