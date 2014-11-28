<h3>Pages:</h3>
<table>
    <thead>
    <tr>
        <td>Page Id</td>
        <td>Page Name</td>
        <td></td>
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
                <form action="updateActor.php" method="post">
                    <input type="text" id="editId" name="editId" value="<?php echo $page->getID(); ?>" hidden />
                    <input type="text" id="editId" name="editFN" value="<?php echo $page->getPageTitle(); ?>" hidden />
                    <input type="Submit" id="edit" name="edit" value="Edit" />

                </form>
            </td>
            <td>
                <form action="deleteActor.php" method="post">
                    <input type="text" id="delId" name="delId" value="<?php echo $page->getID(); ?>" hidden />
                    <input type="Submit" id="del" name="del" value="Delete" />

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>