<!DOCTYPE html>
<html>
<head>
    <title>Page title goes here!</title>
</head>
<body>
<?php
require_once '../Database/dbConn.php';
require_once '../Database/DataAccessMySQLi.php';
require_once '../Business/PageClass.php';
require_once '../Business/ArticleClass.php';
require_once '../Business/ContentAreaClass.php';
require_once '../Business/CssClass.php';
echo "test";
?>
<DIV>
    <h2>Database connection test!</h2>
    <?php

    // $arrayOfPages = ArticleClass::retrieveArticles();
    $arrayOfPages = PageClass::retrievePages();


    foreach ( $arrayOfPages as $page):

        echo "<p>";
        echo $page->getDesc();
        echo "</p>";

    endforeach;

    $singlePage = PageClass::getSinglePage(1);
    echo "<br/><p>";
    echo $singlePage->getId();
    echo $singlePage->getPageTitle();
    echo $singlePage->getCSS();
    echo $singlePage->getDesc();
    echo "</p>";


    ?>
</DIV>
</body>
</html>