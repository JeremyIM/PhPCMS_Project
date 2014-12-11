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
$login = strip_tags( trim($_POST['login']));
$pw = strip_tags( trim($_POST['pw']));

//safety first
$login = stripslashes($login);
$pw = stripslashes($pw);

//TODO: move to DataAccess
//$login = mysqli_real_escape_string($db, $login);
//$pw = mysqli_real_escape_string($db, $pw);

//hash passwords TODO: change to meet REQ-008
//$hashedPw = hash("sha1", $pw);

//build sql + get result
$userObj = UserClass::checkLoginInfo($login);

$test = UserClass::generateHash($pw, $userObj->getWordPassSalt());
/*

$sql = "SELECT * FROM WebUsers WHERE login='$login' AND pw='$hashedPw'";
$result = mysqli_query($db, $sql);

$count = mysqli_num_rows($result);

mysqli_close('$db');
*/
if ($userObj->getId() > 0 && ($test == $userObj->getWordPass())): //check that only 1 user was returned
    //set session variables
    $_SESSION['login'] = $login;
    $_SESSION['pw'] = $pw;

    if((in_array($userObj->getPermission(), [2])))
    {
        $_SESSION['permission'] = "editor";
        header("location:editorPortal.php");
    }
    if(in_array($userObj->getPermission(), [4]))
    {
        $_SESSION['permission'] = "admin";
        header("location:adminPortal.php");
    }
    if(in_array($userObj->getPermission(), [1]))
    {
        $_SESSION['permission'] = "author";
        header("location:index.php");
    }
?>
<form action="logout.php" method="post">
    <input type="Submit" name="logout" value="Logout" />
</form>
<?php
else: //inform user ?>
    <p>"Wrong UserName or Password!</p>
     <a href='login.html'>Back</a>
<?php endif;?>

</body>
</html>