<!DOCTYPE html>
<html>
<?php
session_start();
require_once '../Database/dbConn.php';
require_once '../Database/DataAccessMySQLi.php';
require_once '../Business/PageClass.php';
require_once '../Business/ArticleClass.php';
require_once '../Business/ContentAreaClass.php';
require_once '../Business/CssClass.php';

$pageArray = PageClass::retrievePages();

//if user is author, display author editing capabilities
if($_SESSION['permission'] == "author")
    $authorFlag = true;

if(isset($_GET['page']))
{
    $singlePage = PageClass::getSinglePage($_GET['page']);
    $currentTemplate = CssClass::getActiveCSS();
}
else
{
    $_GET['page'] = 1;
    $singlePage = PageClass::getSinglePage(1);
    $currentTemplate = CssClass::getActiveCSS();
}
?>
    <head>
        <title><?php echo  $singlePage->getPageTitle(); ?></title>

        <style type="text/css">
            <?php echo $currentTemplate->getContent(); ?>
        </style>
    </head>

    <body>

    <nav>
        <ul>
            <?php
            foreach ($pageArray as $page):?>
                <li>
                    <a href="index.php?page=<?php echo $page->getId();?>">
                    <?php echo $page->getWebName();?>
                    </a>
                </li>
            <?php
            endforeach;

            if(isset($authorFlag)): ?>
            <li>
                <form action="authorEdit.php" method="post">
                    <input type="Submit" id="addArticle" name="addArticle" value="Add Article" />
                </form>
            </li>
            <li>
                <form action="logout.php" method="post">
                    <input type="Submit" id="logout" name="logout" value="Logout" />
                </form>
            </li>
            <?php endif;?>
        </ul>
    </nav>
    <br />
    <hr />
    <?php
    // BUILD OUR PAGE CONTENT
    // obtain/receive all content areas ($areaArray)
    // get them in ORDER
    // every page gets all content areas (they may be empty)
    // so I do not need to tie to current page
    $areaArray = ContentAreaClass::retrieveDivs();

    foreach ($areaArray as $area):?>

        <!-- all of our content areas are DIVs -->
        <div id="<?php echo $area->getDivName();?>" />
    <?php
        // obtain/receive all articles ($articleArray)
        // for the current page (or for all pages)
        // and for the current area
        // in REVERSE ORDER of creation date
        $articleArray = ArticleClass::getAreaArticles($_GET['page'], $area->getId());
        foreach ($articleArray as $article):?>

            <article id="<?php echo $article->getWebName();?>" />

                <?php echo $article->getContent();?>
                <?php echo $article->createDate();?>

            <!-- button for editing current article -->
            <?php if(isset($authorFlag)): ?>
            <form action="authorEdit.php" method="post">
                <input type="text" id="editArticleId" name="editArticleId" value="<?php echo $article->getID(); ?>" hidden />
                <input type="Submit" id="editAuthorArticle" name="editAuthorArticle" value="Edit" />
            </form>
            <?php endif; ?>

            </article>
        <?php endforeach; ?>

        </div>
    <?php endforeach; ?>

    </body>

</html>