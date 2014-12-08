<?php

require '../Business/ContentAreaClass.php';

//build new article business object
$newDiv = new ContentAreaClass($_POST['dName'], $_POST['dDivName']);
$newDiv->setDesc($_POST['aDesc']);
$newDiv->setOrder($_POST['dOrder']);

//call ContentArea's save function
$result = $newDiv->saveDiv();

//report success/failure
echo $result;

?>

