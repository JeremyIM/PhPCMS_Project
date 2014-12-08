<h3>Content Areas:</h3>
<table>
    <thead>
        <tr>
            <td>Content Area Id</td>
            <td>Content Area Name</td>
            <td colspan="2">
                <form action="editorPortal.php" method="post">
                    <input type="Submit" id="addDiv" name="addDiv" value="Add Content Area" />

                </form>
            </td>
        </tr>
    </thead>

    <tbody>
    <?php
    require("../Business/ContentAreaClass.php");

    $arrayOfDivs = ContentAreaClass::retrieveDivs();

    foreach($arrayOfDivs as $div):

        ?>
        <tr>
            <td><?php echo $div->getId(); ?></td>
            <td><?php echo $div->getName(); ?></td>
            <td>
                <form action="editorPortal.php" method="post">
                    <input type="text" id="editDivId" name="editDivId" value="<?php echo $div->getId(); ?>" hidden />
                    <input type="Submit" id="editDiv" name="editDiv" value="Edit" />

                </form>
            </td>
            <td>
                <form action="editorPortal.php" method="post">
                    <input type="text" id="delDivId" name="delDivId" value="<?php echo $div->getId(); ?>" hidden />
                    <input type="Submit" id="delDiv" name="delDiv" value="Delete" />

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>