<?php

require '../Business/CssClass.php';
require '../Business/UserClass.php';
$userObj = UserClass::checkLoginInfo($_SESSION['login']);

//build new article business object
$newCss = new CssClass($_POST['cName'], $_POST['cContent']);

$newCss->setDesc($_POST['cDesc']);
$newCss->setActive($_POST['cActive']);

$newCss->setCreator($userObj->getId());
$result = $newCss->saveTemplate();

//report success/failure
echo $result;

?>

