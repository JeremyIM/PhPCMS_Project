<?php
require '../Business/UserClass.php';
require '../Business/CssClass.php';

//build new article business object
$userObj = UserClass::checkLoginInfo($_SESSION['login'], $_SESSION['pw']);
$newCss = new CssClass($_POST['cName'], $_POST['cContent']);

$newCss->setDesc($_POST['cDesc']);
$newCss->setActive($_POST['cActive']);
$newCss->setCreator($userObj->getId());
$result = $newCss->saveTemplate();

//report success/failure
echo $result;

?>

