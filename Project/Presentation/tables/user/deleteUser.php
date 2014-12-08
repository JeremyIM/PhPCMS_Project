<h3>Delete Page</h3>
<?php
require '../Business/UserClass.php';
$currentUser = UserClass::getSingleUser($_POST['delUserID']);
?>
<p>
    Really delete user #<?php echo $currentUser->getId(); ?> : <?php echo $currentUser->getUsername(); ?>?
</p>

<form action="adminPortal.php" method="post">
    <input type="text" id="delUserId" name="delUserId" value="<?php echo $currentUser->getID(); ?>" hidden />
    <input type="Submit" id="deletedUser" name="deletedUser" value="Confirm Delete" />

</form>