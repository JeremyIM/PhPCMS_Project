<?php

function checkIfLoggedIn()
{
    session_start();//start session
    if (empty($_SESSION['login']) || empty($_SESSION['pw']))
    {
        header("location:login.html");
    }//end if
}//end login check

?>