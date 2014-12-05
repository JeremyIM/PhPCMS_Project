<html>
<head>
    <title></title>
    <style type="text/css">
        ul li {
            float: left;
            padding-right: 1%;

            list-style-type: none;
        }
        table
        {
            border: 1px solid purple;
        }
        th, td
        {
            border: 1px solid red;
        }
    </style>
</head>

<body>
    <h2>Welcome to the Editor Portal</h2>

    <ul>
        <li>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="submit" name="pageMgmtBtn" value="Page Management" />
            </form>
        </li>
        <li>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="submit" name="articleMgmtBtn" value="Article Management" />
            </form>
        </li>
        <li>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="submit" name="divMgmtBtn" value="Content Area Management" />
            </form>
        </li>
        <li>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="submit" name="cssMgmtBtn" value="CSS Template Management" />
            </form>
        </li>
    </ul>
    <br />
    <br />
    <hr />

    <?php
    //check to see which button was clicked and then display the appropriate mgmt interface

    //////////////////////////////////////////
    //            Page MGMT Block          //
    ////////////////////////////////////////
    if(isset($_POST['pageMgmtBtn']))
    {
        include_once 'tables/pageMgmt.php';
    }

    elseif(isset($_POST['editPage']))
    {
        //load the divs management table\
        include_once 'tables/page/page.php';
    }
    elseif(isset($_POST['addPage']))
    {
        //load the divs management table\
        include_once 'tables/page/page.php';
    }
    elseif(isset($_POST['delPage']))
    {
        //load delete confirmation page
        include_once 'tables/page/deletePage.php';
    }

    //post effect
    elseif(isset($_POST['addedPage'])) //post inserting
    {
        //load insert routine + success/fail message
        include_once 'tables/page/addPage.php';
    }
    elseif(isset($_POST['editedPage'])) //post editing
    {
        //load update routine + success/fail message
        include_once 'tables/page/editPage.php';
    }
    elseif(isset($_POST['deletedPage']))
    {
        //delete selected article
        require_once '../Business/PageClass.php';
        $currentPage = PageClass::getSinglePage($_POST['delPageId']);

        $result = $currentPage->deletePage();
        echo $result;
    }
    //////////////////////////////////////////
    //          Article MGMT Block         //
    ////////////////////////////////////////
    if(isset($_POST['articleMgmtBtn']))
    {
        //load the articles management table
        include_once 'tables/articleMgmt.php';
    }
    elseif(isset($_POST['addArticle'])) //pre insert
    {
        //load empty form + pointer to insert routine
        include_once 'tables/article/article.php';
    }
    elseif(isset($_POST['editArticle'])) //pre update
    {
        //load pre-populated form + pointer to update routine
        include_once 'tables/article/article.php';
    }
    elseif(isset($_POST['delArticle']))
    {
        //load delete confirmation page
        include_once 'tables/article/deleteArticle.php';
    }

    //post effect
    elseif(isset($_POST['addedArticle'])) //post inserting
    {
        //load insert routine + success/fail message
        include_once 'tables/article/addArticle.php';
    }
    elseif(isset($_POST['editedArticle'])) //post editing
    {
        //load update routine + success/fail message
        include_once 'tables/article/editArticle.php';
    }
    elseif(isset($_POST['deletedArticle']))
    {
        //delete selected article
        require_once '../Business/ArticleClass.php';
        $currentArticle = ArticleClass::getSingleArticle($_POST['delArticleId']);

        $result = $currentArticle->deleteArticle();
        echo $result;

    }


    //////////////////////////////////////////
    //            Div MGMT Block           //
    ////////////////////////////////////////
    if(isset($_POST['divMgmtBtn']))
    {
        //load the divs management table\
        include_once 'tables/divMgmt.php';
    }

    elseif(isset($_POST['editDiv']))
    {
        //load the divs management table\
        include_once 'tables/div/div.php';
    }
    elseif(isset($_POST['addDiv']))
    {
        //load the divs management table\
        include_once 'tables/div/div.php';
    }
    elseif(isset($_POST['delDiv']))
    {
        //load delete confirmation page
        include_once 'tables/div/deleteDiv.php';
    }

    //post effect
    elseif(isset($_POST['addedDiv'])) //post inserting
    {
        //load insert routine + success/fail message
        include_once 'tables/div/addDiv.php';
    }
    elseif(isset($_POST['editedDiv'])) //post editing
    {
        //load update routine + success/fail message
        include_once 'tables/div/editDiv.php';
    }
    elseif(isset($_POST['deletedDiv']))
    {
        //delete selected article
        require_once '../Business/ContentAreaClass.php';
        $currentDiv = ContentAreaClass::getSingleDiv($_POST['delDivId']);

        $result = $currentDiv->deleteDiv();
        echo $result;

    }
    //////////////////////////////////////////
    //         Template MGMT Block         //
    ////////////////////////////////////////
    if(isset($_POST['cssMgmtBtn']))
    {
        //load the templates management table
        include_once 'tables/cssMgmt.php';
    }

    elseif(isset($_POST['editCss']))
    {
        //load the divs management table\
        include_once 'tables/css/css.php';
    }
    elseif(isset($_POST['addCss']))
    {
        //load the divs management table\
        include_once 'tables/css/css.php';
    }
    elseif(isset($_POST['delCss']))
    {
        //load delete confirmation page
        include_once 'tables/css/deleteCss.php';
    }

    //post effect
    elseif(isset($_POST['addedCss'])) //post inserting
    {
        //load insert routine + success/fail message
        include_once 'tables/css/addCss.php';
    }
    elseif(isset($_POST['editedCss'])) //post editing
    {
        //load update routine + success/fail message
        include_once 'tables/css/editCss.php';
    }
    elseif(isset($_POST['deletedCss']))
    {
        //delete selected article
        require_once '../Business/CssClass.php';
        $currentCss = CssClass::getSingleTemplate($_POST['delCssId']);

        $result = $currentCss->deleteTemplate();
        echo $result;
    }

    ?>

    <?php

    //if currentUser == Editor
    //load editor management options
    //manage pages
        //Create new Page

        //Update Existing Page

        //Delete Page + Remove related Article's page_id

    //manage content areas
        //
    //manage articles
        //Create new Article

        //Update Existing Article

        //Delete Existing Article
    //manage templates


    ?>


</body>

</html>