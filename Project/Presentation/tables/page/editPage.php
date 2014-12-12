<?php

require '../Business/PageClass.php';
require '../Business/UserClass.php';
$userObj = UserClass::checkLoginInfo($_SESSION['login']);

//build new article business object
$newPage = new PageClass($_POST['pName'], $_POST['pWebName']);
$newPage->setId($_POST['editPageId']);
$newPage->setDesc($_POST['pDesc']);
$newPage->setCSS($_POST['pCss']);
$newPage->setModBy($userObj->getId());

$result = $newPage->updatePage();

//report success/failure
echo $result;

?>

