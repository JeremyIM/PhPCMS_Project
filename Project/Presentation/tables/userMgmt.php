<h3>Pages:</h3>
<table>
    <thead>
    <tr>
        <td>User Id</td>
        <td>Username</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Password</td>
        <td>Created By</td>
        <td>Date Created</td>
        <td>Modified By</td>
        <td>Last Modified</td>

        <td colspan="2">
            <form action="adminPortal.php" method="post">
                <input type="text" name="addPage" value="addPage" hidden />
                <input type="Submit" id="addUser" name="addUser" value="Add User" />

            </form>
        </td>
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
            <td><?php echo $page->getWordPass(); ?></td>
            <td><?php echo $page->getCreatedBy(); ?></td>
            <td><?php echo $page->getCreatedDate(); ?></td>
            <td><?php echo $page->getModifier(); ?></td>
            <td><?php echo $page->getModDate(); ?></td>
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