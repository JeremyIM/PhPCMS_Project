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
                <input type="text" name="pages" value="pages" hidden />
                <input type="submit" name="pageMgmtBtn" value="Page Management" />
            </form>
        </li>
        <li>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="articles" value="articles" hidden />
                <input type="submit" name="articleMgmtBtn" value="Article Management" />
            </form>
        </li>
        <li>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="divs" value="divs" hidden />
                <input type="submit" name="divMgmtBtn" value="Content Area Management" />
            </form>
        </li>
        <li>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="css" value="css" hidden />
                <input type="submit" name="cssMgmtBtn" value="CSS Template Management" />
            </form>
        </li>
    </ul>
    <br />
    <br />
    <hr />

    <?php
    //check to see which button was clicked and then display the appropriate mgmt interface
    if(isset($_POST['pages']))
    {
        include_once '../Presentation/tables/pageMgmt.php';
    }
    else if(isset($_POST['articles']))
    {
        //load the articles management table
        include_once '../Presentation/tables/articleMgmt.php';
    }
    else if(isset($_POST['divs']))
    {
        //load the divs management table\
        include_once '../Presentation/tables/divMgmt.php';
    }
    else if(isset($_POST['css']))
    {
        //load the templates management table
        include_once '../Presentation/tables/cssMgmt.php';
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