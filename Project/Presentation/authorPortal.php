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
    <?php
    require("../Business/UserClass.php");

    $arrayOfPages = UserClass::retrieveUsers();

    foreach($arrayOfPages as $page):
        $var = $page->getPermission();

        ?>
        <tr>
            <td><?php echo $page->getID(); ?></td>
            <td><?php echo $page->getUsername(); ?></td>
            <td><?php echo $page->getFistName(); ?></td>
            <td><?php echo $page->getLastName(); ?></td>

            <td>
                <input type="checkbox" disabled="disabled" id="userIsAdmin" name="userIsAdmin" <?php if(in_array($var, [4,5,6,7])){echo "checked";}?>  />
            </td>
            <td>
                <input type="checkbox" disabled="disabled" id="userIsEditor" name="userIsEditor" <?php if(in_array($var, [2,3,6,7])){echo "checked";}?>/>
            </td>
            <td>
                <input type="checkbox" disabled="disabled" id="userIsAuthor" name="userIsAuthor"<?php if(in_array($var, [1,3,5,7])){echo "checked";}?>/>
            </td>

            <form action="adminPortal.php" method="post">
                <input type="text" id="editUserPrivId" name="editUserPrivId" value="<?php echo $page->getID(); ?>" hidden />
                <td colspan="2"><input type="Submit" id="editUserPriv" name="editUserPriv" value="Update User" /></td>
            </form>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>