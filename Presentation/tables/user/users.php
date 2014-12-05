<?php //TODO: add conditional for header (add/edit) ?>

<h3>Edit User:</h3>
<form action="adminPortal.php" method="post">


    <?php
    require("../Business/UserClass.php");

    $currentUser = UserClass::getSingleUser($_POST['editUserId']);




    //TODO: add code to preset pageOn and divIn selected option values (add vs edit?)

    ?>

    <table>
        <tr>
            <td>Username: </td>
            <td><input type="text" id="uUsername" name="uUsername" value="<?php echo $currentUser->getUsername(); ?>" /></td>
        </tr>
        <tr>
            <td>First Name: </td>
            <td><input type="text" id="uFirstname" name="uFirstname" value="<?php echo $currentUser->getFistName(); ?>" /></td>
        </tr>
        <tr>
            <td>Last Name: </td>
            <td><input type="text" id="uLastname" name="uLastname" value="<?php echo $currentUser->getLastName(); ?>" /></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><input type="text" id="uWordpass" name="uWordpass" value="<?php echo $currentUser->getWordPass(); ?>" /></td>
        </tr>



        <tr>
            <?php if(isset($_POST['addUser'])): ?>
                <td colspan="2"><input type="Submit" id="addedUser" name="addedUser" value="Add User" /></td>
            <?php endif; ?>

            <?php if(isset($_POST['editUserId'])): ?>
                <input type="text" id="editUserId" name="editUserId" value="<?php echo $_POST['editUserId'] ?>" hidden />
                <td colspan="2"><input type="Submit" id="editedUser" name="editedUser" value="Update User" /></td>
            <?php endif; ?>
        </tr>
    </table>
</form>