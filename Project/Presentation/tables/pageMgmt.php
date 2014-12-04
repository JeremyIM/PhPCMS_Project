<h3>Pages:</h3>
<table>
    <thead>
    <tr>
        <td>Page Id</td>
        <td>Page Name</td>
        <td colspan="2">
            <form action="../Pages.php" method="post">
                <input type="text" name="addPage" value="addPage" hidden />
                <input type="Submit" id="add" name="add" value="Add Page" />

            </form>
        </td>
    </tr>
    </thead>
    <tbody>
    <?php
    require("../Business/PageClass.php");

    $arrayOfPages = PageClass::retrievePages();

    foreach($arrayOfPages as $page):

        ?>
        <tr>
            <td><?php echo $page->getID(); ?></td>
            <td><?php echo $page->getPageTitle(); ?></td>
            <td>
                <form action="" method="post">
                    <input type="text" id="editId" name="editId" value="<?php echo $page->getID(); ?>" hidden />
                    <input type="text" id="editId" name="editTitle" value="<?php echo $page->getPageTitle(); ?>" hidden />
                    <input type="Submit" id="edit" name="edit" value="Edit" />

                </form>
            </td>
            <td>
                <form action="" method="post">
                    <input type="text" id="delId" name="delId" value="<?php echo $page->getID(); ?>" hidden />
                    <input type="Submit" id="del" name="del" value="Delete" />

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>