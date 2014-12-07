<?php
session_start(); //start session
//call db functions

require '../Business/UserClass.php';


?>


<html>
<head>
    <title>Check Login</title>
</head>

<body>

<?php
//grab login info passed in
$login = $_POST['login'];
$pw = $_POST['pw'];

//safety first
$login = stripslashes($login);
$pw = stripslashes($pw);

//TODO: move to DataAccess
//$login = mysqli_real_escape_string($db, $login);
//$pw = mysqli_real_escape_string($db, $pw);

//hash passwords TODO: change to meet REQ-008
//$hashedPw = hash("sha1", $pw);

//build sql + get result
$userObj = UserClass::checkLoginInfo($login, $pw);

/*

$sql = "SELECT * FROM WebUsers WHERE login='$login' AND pw='$hashedPw'";
$result = mysqli_query($db, $sql);

$count = mysqli_num_rows($result);

mysqli_close('$db');
*/
if ($userObj) //check that only 1 user was returned
{
    //set session variables
    $_SESSION['login'] = $login;
    $_SESSION['pw'] = $pw;

    if($userObj->getUsername() == "editor")
    {
        header("location:editorPortal.php");
    }
    if($userObj->getUsername() == "admin")
    {
        header("location:adminPortal.php");
    }
    //if uer is author
}
else
{
    //inform user
    echo "Wrong UserName or Password! <br/>";
    echo "<a href='login.html'>Back</a>";
}

ob_end_flush();

?>
<form action="Logout.php" method="post">
    <input type="Submit" name="logout" value="Logout" />
</form>

</body>
</html>