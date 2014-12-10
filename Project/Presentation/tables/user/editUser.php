<?php
require '../Business/UserClass.php';
$userObj = UserClass::checkLoginInfo($_SESSION['login'], $_SESSION['pw']);
//TODO When user is updated, permissions are erased. I canZ haZ fix plz?
//build new article business object
$newUser = new UserClass($_POST['uUsername']);
$newUser->setId($_POST['editUserId']);
$newUser->setUsername(strip_tags( trim($_POST['uUsername'])));
$newUser->setFistName(strip_tags( trim($_POST['uFirstname'])));
$newUser->setLastName(strip_tags( trim($_POST['uLastname'])));
$newUser->setWordpassSalt($newUser->generateSalt());
$newUser->setWordPass($newUser->generateHash($_POST['uWordpass'],$newUser->getWordPassSalt()));
$newUser->setModifier($userObj->getId());

$result = $newUser->updateUser();
//report success/failure
echo $result;
?>