<?php

require_once'../Business/ArticleClass.php';
require '../Business/UserClass.php';
$userObj = UserClass::checkLoginInfo($_SESSION['login'], $_SESSION['pw']);

//build new article business object
$newArticle = new ArticleClass($_POST['aWebName'], $_POST['aTitle'], $_POST['aContent']);
$newArticle->setId($_POST['editArticleId']);
$newArticle->setDesc($_POST['aDesc']);
$newArticle->setDivContainer($_POST['aDivIn']);

if($_POST['aPageOn'] == "all_pages")
{
    $newArticle->setAllPagesBool(1);
}
else //specific page selected from drop down
{
    $newArticle->setAllPagesBool(0);
    $newArticle->setPageOn($_POST['aPageOn']);
}

$newArticle->setModBy($userObj->getId());
$result = $newArticle->updateArticle();
//report success/failure
echo $result;

?>

