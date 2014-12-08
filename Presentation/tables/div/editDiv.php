<?php

require '../Business/ContentAreaClass.php';
require '../Business/UserClass.php';
//build new article business object
$newDiv = new ContentAreaClass($_POST['dName'], $_POST['dDivName']);
$userObj = UserClass::checkLoginInfo($_SESSION['login'], $_SESSION['pw']);
$newDiv->setId($_POST['editDivId']);
$newDiv->setDesc($_POST['aDesc']);
$newDiv->setOrder($_POST['dOrder']);
$newDiv->setModBy($userObj->getId());

//call ContentArea's save function
$result = $newDiv->updateDiv();

//report success/failure
echo $result;

?>

