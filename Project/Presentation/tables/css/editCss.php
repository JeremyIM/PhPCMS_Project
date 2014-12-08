<?php

require '../Business/CssClass.php';

//build new article business object
$newCss = new CssClass($_POST['cName'], $_POST['cContent']);
$newCss->setId($_POST['editCssId']);
$newCss->setDesc($_POST['cDesc']);
$newCss->setActive($_POST['cActive']);

$result = $newCss->updateTemplate();

//report success/failure
echo $result;

?>

