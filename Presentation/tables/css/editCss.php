<?php
require '../Business/UserClass.php';
require '../Business/CssClass.php';

//build new article business object
$userObj = UserClass::checkLoginInfo($_SESSION['login'], $_SESSION['pw']);
$newCss = new CssClass($_POST['cName'], $_POST['cContent']);
$newCss->setId($_POST['editCssId']);
$newCss->setDesc($_POST['cDesc']);
$newCss->setActive($_POST['cActive']);
$newCss->setModBy($userObj->getId());
$result = $newCss->updateTemplate();

//report success/failure
echo $result;

?>

