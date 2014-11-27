<!DOCTYPE html>
<html>
    <?php
    require_once '../Database/dbConn.php';
    require_once '../Database/DataAccessMySQLi.php';
    require_once '../Business/PageClass.php';
    require_once '../Business/ArticleClass.php';
    require_once '../Business/ContentAreaClass.php';
    require_once '../Business/CssClass.php';


    $pageArray = PageClass::retrievePages();
  //  $cssArray = CssClass::retrieveTemplates();
    $singlePage = PageClass::getSinglePage(1);
        // WARNING: PSEUDO_CODE ONLY
        // this may be a presentation page in 3-tier or a view in MVC
        // I am doing a bit too much echoing HTML (li tags, etc.) but wanted to simplify

		// FIND OUT WHAT PAGE WE ARE ON
        // obtain/receive the current page ($currentPage)
        // using GET from the nav or if none then default page

		// FIND OUT WHAT STYLE TEMPLATE WE ARE USING
        // obtain/receive the active style/template ($currentTemplate)
    ?>
    <title><?php echo  $singlePage->getPageTitle(); ?></title>
    <style type="text/css">
        <?php// echo $currentTemplate->getContent(); ?>
    </style>
    </head>
    <body>
    <header>
        <h1><?php echo  $singlePage->getWebName(); ?></h1>
    </header>
    <nav>
        <ul>
            <?php
            // BUILD OUR NAV
            // obtain/receive all page objects ($pageArray)
            // use GET in the links of each page to tell us which page they w ant

            foreach ($pageArray as $page)
            {
                echo "<li>";
                echo "<a href='index.php?page=$page->getWebName()'> $page->getWebName()</a>";
                echo "</li>";
            }
            ?>
        </ul>
    </nav>
    <section>
        <?php
        // BUILD OUR PAGE CONTENT
        // obtain/receive all content areas ($areaArray)
        // get them in ORDER
        // every page gets all content areas (they may be empty)
        // so I do not need to tie to current page
        foreach ($areaArray as $area)
        {
            // all of our content areas are DIVs
            echo "<div id='$area->getAlias()'>";

            // obtain/receive all articles ($articleArray)
            // for the current page (or for all pages)
            // and for the current area
            // in REVERSE ORDER of creation date
            foreach ($articleArray as $article)
            {
                echo "<article id='$article->getAlias()'>";

                echo $article->getContent();

                echo "</article>";
            }

            echo "</div>";
        }

        ?>
    </section>
    </body>
</html>