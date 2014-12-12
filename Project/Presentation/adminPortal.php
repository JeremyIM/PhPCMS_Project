<?php //check to make sure user is logged in
require 'isLoggedIn.php';
checkIfLoggedIn();

//$_SESSION['permission'] = "admin";
?>

<html>
<head>
    <title>Admin Portal</title>
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script src="mce.js"></script>
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
<h2>Welcome to the Admin Portal</h2>

<ul>
    <li>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" name="userMgmtBtn" value="User Management " />
        </form>
    </li>
    <li>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" name="userPrivBtn" value="User Privileges " />
        </form>
    </li>

    <li>
        <form method="post" action="logout.php">
            || <input type="submit" name="logout" value="logout" />
        </form>
    </li>
</ul>
<br />
<br />
<hr />

<?php
//check to see which button was clicked and then display the appropriate mgmt interface
//////////////////////////////////////////
//            User MGMT Block          //
////////////////////////////////////////
if(isset($_POST['userMgmtBtn']))
{
    //load the articles management table
    include_once 'tables/userMgmt.php';
}
elseif(isset($_POST['addUser'])) //pre insert
{
    //load empty form + pointer to insert routine
    include_once 'tables/user/users.php';
}
elseif(isset($_POST['editUser'])) //pre update
{
    //load pre-populated form + pointer to update routine
    include_once 'tables/user/users.php';
}
elseif(isset($_POST['delUser']))
{
    //load delete confirmation page
    include_once 'tables/user/deleteUser.php';
}
//***********************************************//
//post effect
elseif(isset($_POST['addedUser'])) //post inserting
{
    //load insert routine + success/fail message
    include_once 'tables/user/addUser.php';
}
elseif(isset($_POST['editedUser'])) //post editing
{
    //load update routine + success/fail message
    include_once 'tables/user/editUser.php';
}
elseif(isset($_POST['deletedUser']))
{
    //delete selected article
    require_once '../Business/UserClass.php';
    $currentUser = UserClass::getSingleUser($_POST['delUserId']);

    $result = $currentUser->deleteUser();
    echo $result;
}
if(isset($_POST['userPrivBtn']))
{
    //load the articles management table
    include_once 'tables/userPrivMgmt.php';
}
elseif(isset($_POST['editUserPriv'])) //pre insert
{
    //load empty form + pointer to insert routine
    include_once 'tables/userPriv/users.php';
}
elseif(isset($_POST['editedUserPriv'])) //pre insert
{
    //load empty form + pointer to insert routine
    include_once 'tables/userPriv/editUsers.php';
}
?>

</body>

</html>