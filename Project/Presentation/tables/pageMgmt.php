<h3>Pages:</h3>
<table>
    <thead>
    <tr>
        <td>Page Id</td>
        <td>Page Name</td>
        <td colspan="2">
            <form action="editorPortal.php" method="post">
                <input type="Submit" id="addPage" name="addPage" value="Add Page" />

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
                <form action="editorPortal.php" method="post">
                    <input type="text" id="editPageId" name="editPageId" value="<?php echo $page->getID(); ?>" hidden />
                    <input type="Submit" id="editPage" name="editPage" value="Edit" />

                </form>
            </td>
            <td>
                <form action="editorPortal.php" method="post">
                    <input type="text" id="delPageId" name="delPageId" value="<?php echo $page->getID(); ?>" hidden />
                    <input type="Submit" id="delPage" name="delPage" value="Delete" />

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>