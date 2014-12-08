<?php

require '../Business/PageClass.php';
require '../Business/UserClass.php';

//build new article business object
$newPage = new PageClass($_POST['pName'], $_POST['pWebName']);

$userObj = UserClass::checkLoginInfo($_SESSION['login'], $_SESSION['pw']);

$newPage->setDesc($_POST['pDesc']);
$newPage->setCSS($_POST['pCss']);
$newPage->setCreator($userObj->getId());


$result = $newPage->savePage();

//report success/failure
echo $result;

?>

