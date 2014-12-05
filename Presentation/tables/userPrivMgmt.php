<h3>Pages:</h3>
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

        ?>
        <tr>
            <td><?php echo $page->getID(); ?></td>
            <td><?php echo $page->getUsername(); ?></td>
            <td><?php echo $page->getFistName(); ?></td>
            <td><?php echo $page->getLastName(); ?></td>

            <td>
                <form action="adminPortal.php" method="post">
                    <input type="text" id="editUserId" name="editUserId" value="<?php echo $page->getID(); ?>" hidden /><input type="text" id="editId" name="editUserUsername" value="<?php echo $page->getUsername(); ?>" hidden />
                    <input type="Submit" id="editUser" name="editUser" value="Edit" />

                </form>
            </td>
            <td>
                <form action="adminPortal.php" method="post">
                    <input type="text" id="delUserID" name="delUserID" value="<?php echo $page->getID(); ?>" hidden />
                    <input type="Submit" id="delUser" name="delUser" value="Delete" />

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>