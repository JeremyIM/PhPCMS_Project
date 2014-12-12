<?php

require '../Business/CssClass.php';
require '../Business/UserClass.php';
$userObj = UserClass::checkLoginInfo($_SESSION['login']);

//build new article business object
$newCss = new CssClass($_POST['cName'], $_POST['cContent']);
$newCss->setId($_POST['editCssId']);
$newCss->setDesc($_POST['cDesc']);
$newCss->setActive($_POST['cActive']);
$newCss->setModBy($userObj->getId());

$result = $newCss->updateTemplate();

//report success/failure
echo $result;

?>

