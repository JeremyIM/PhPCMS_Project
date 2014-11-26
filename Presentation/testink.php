<!DOCTYPE html>
<html>
    <head>
        <title>Page title goes here!</title>
    </head>
    <body>
        <?php
            require_once '../Database/dbConn.php';
            require_once '../Database/DataAccessMySQLi.php';
            echo "test";
        ?>
        <DIV>
            <h2>Database connection test!</h2>
            <?php
            $myDataAccess = dataAccess::getInstance();
            $myDataAccess->getDBConn();
            $myDataAccess->closeDBConn();


            ?>
        </DIV>
    </body>
</html>