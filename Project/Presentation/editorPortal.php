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
    //////////////////////////////////////////
    //          Article MGMT Block         //
    ////////////////////////////////////////
    if(isset($_POST['articleMgmtBtn']))
    {
        //load the articles management table
        include_once 'tables/articleMgmt.php';
    }
    if(isset($_POST['addArticle']))
    {
        //load empty form + pointer to insert routine
        include_once 'tables/article.php';
    }
    if(isset($_POST['editArticle']))
    {
        //load pre-populated form + pointer to update routine
        include_once 'tables/article.php';
    }
    if(isset($_POST['addedArticle']))
    {
        //load insert routine + success/fail message
        include_once 'tables/addArticle.php';
    }
    if(isset($_POST['editedArticle']))
    {
        //load update routine + success/fail message
        include_once 'tables/editArticle.php';
    }
    //////////////////////////////////////////
    //            Div MGMT Block           //
    ////////////////////////////////////////
    if(isset($_POST['divMgmtBtn']))
    {
        //load the divs management table\
        include_once 'tables/divMgmt.php';
    }
    //////////////////////////////////////////
    //         Template MGMT Block         //
    ////////////////////////////////////////
    if(isset($_POST['cssMgmtBtn']))
    {
        //load the templates management table
        include_once 'tables/cssMgmt.php';
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