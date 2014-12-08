<?php

require '../Business/UserClass.php';

//build new article business object
                if(isset($_POST['userIsAdmin']))
                {
                    $privStatus.=decbin(1);
                }
                else
                {
                    $privStatus.=decbin(0);
                }
                if(isset($_POST['userIsEditor']))
                {
                    $privStatus.=decbin(1);
                }
                else
                {
                    $privStatus.=decbin(0);
                }
                if(isset($_POST['userIsAuthor']))
                {
                    $privStatus.=decbin(1);
                }
                else
                {
                    $privStatus.=decbin(0);
                }
$userObj = UserClass::checkLoginInfo($_SESSION['login'], $_SESSION['pw']);
$newUser = new UserClass($_POST['uUsername']);
$newUser->setId($_POST['editedUserPrivId']);
$newUser->setPermission(bindec($privStatus));
$newUser->setModifier($userObj->getId());
$result = $newUser->updateUserPriv();

//report success/failure
echo $result;

?>