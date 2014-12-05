<?php

require '../Business/ContentAreaClass.php';

//build new article business object
$newDiv = new ContentAreaClass($_POST['dName'], $_POST['dDivName']);
$newDiv->setId($_POST['editDivId']);
$newDiv->setDesc($_POST['aDesc']);
$newDiv->setOrder($_POST['dOrder']);

//call ContentArea's save function
$result = $newDiv->updateDiv();

//report success/failure
echo $result;

?>

