<?php

require '../Business/UserClass.php';

//build new article business object
$newUser = new UserClass($_POST['uUsername']);
$newUser->setFistName($_POST['uFirstname']);
$newUser->setLastName($_POST['uLastname']);
$newUser->setWordPass($_POST['uWordpass']);

$result = $newUser->saveUser();

//report success/failure
echo $result;

?>