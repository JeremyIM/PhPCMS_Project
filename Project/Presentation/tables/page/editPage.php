<?php

require '../Business/PageClass.php';

//build new article business object
$newPage = new PageClass($_POST['pName'], $_POST['pWebName']);
$newPage->setId($_POST['editPageId']);
$newPage->setDesc($_POST['pDesc']);
$newPage->setCSS($_POST['pCss']);

$result = $newPage->updatePage();

//report success/failure
echo $result;

?>

