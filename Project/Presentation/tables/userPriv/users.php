<?php //TODO: add conditional for header (add/edit) ?>

<h3>Edit User:</h3>
<form action="adminPortal.php" method="post">


    <?php
    require("../Business/UserClass.php");

    $currentUser = UserClass::getSingleUser($_POST['editUserPrivId']);

    $privStatus; //used to calculate privli
    $var = $currentUser->getPermission();

    //TODO: add code to preset pageOn and divIn selected option values (add vs edit?)

    ?>

    <table>
        <thead>
        <tr>
            <td>User Id</td>
            <td>Username</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Is User Admin</td>
            <td>Is User Editor</td>
            <td>Is User Author</td>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $currentUser->getID(); ?></td>
            <td><?php echo $currentUser->getUsername(); ?></td>
            <td><?php echo $currentUser->getFistName(); ?></td>
            <td><?php echo $currentUser->getLastName(); ?></td>

            <td>
                <input type="checkbox" id="userIsAdmin" name="userIsAdmin" <?php if(in_array($var, [4,5,6,7])){echo "checked";}?>  />
            </td>
            <td>
                <input type="checkbox" id="userIsEditor" name="userIsEditor" <?php if(in_array($var, [2,3,6,7])){echo "checked";}?>/>
            </td>
            <td>
                <input type="checkbox" id="userIsAuthor" name="userIsAuthor"<?php if(in_array($var, [1,3,5,7])){echo "checked";}?>/>
            </td>

            <form action="adminPortal.php" method="post">

                <input type="text" id="editedUserPrivId" name="editedUserPrivId" value="<?php echo $_POST['editUserPrivId'] ?>" hidden />
                <td colspan="2"><input type="Submit" id="editedUserPriv" name="editedUserPriv" value="Update User" /></td>
            </form>
        </tr>
        </tbody>
    </table>
</form>