<?php

require '../Business/PageClass.php';
require '../Business/UserClass.php';
$userObj = UserClass::checkLoginInfo($_SESSION['login'], $_SESSION['pw']);

//build new article business object
$newPage = new PageClass($_POST['pName'], $_POST['pWebName']);

$newPage->setDesc($_POST['pDesc']);
$newPage->setCSS($_POST['pCss']);
$newPage->setCreator($userObj->getId());

$result = $newPage->savePage();

//report success/failure
echo $result;

?>

