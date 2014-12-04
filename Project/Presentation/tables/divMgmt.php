<h3>Content Areas:</h3>
<table>
    <thead>
        <tr>
            <td>Content Area Id</td>
            <td>Content Area Name</td>
            <td colspan="2">
                <form action="../Divs.php" method="post">
                    <input type="text" name="addDiv" value="addDiv" hidden />
                    <input type="Submit" id="add" name="add" value="Add Content Area" />

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
                <form action="" method="post">
                    <input type="text" id="editId" name="editId" value="<?php echo $div->getId(); ?>" hidden />
                    <input type="text" id="editId" name="editName" value="<?php echo $div->getName(); ?>" hidden />
                    <input type="Submit" id="edit" name="edit" value="Edit" />

                </form>
            </td>
            <td>
                <form action="" method="post">
                    <input type="text" id="delId" name="delId" value="<?php echo $div->getId(); ?>" hidden />
                    <input type="Submit" id="del" name="del" value="Delete" />

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>