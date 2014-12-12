<?php

require '../Business/ContentAreaClass.php';
require '../Business/UserClass.php';
$userObj = UserClass::checkLoginInfo($_SESSION['login']);

//build new article business object
$newDiv = new ContentAreaClass($_POST['dName'], $_POST['dDivName']);
$newDiv->setDesc($_POST['aDesc']);
$newDiv->setOrder($_POST['dOrder']);

$newDiv->setCreator($userObj->getId());
//call ContentArea's save function
$result = $newDiv->saveDiv();

//report success/failure
echo $result;

?>

