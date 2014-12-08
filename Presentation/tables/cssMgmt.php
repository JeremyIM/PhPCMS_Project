<h3>CSS Templates:</h3>
<table>
    <thead>
    <tr>
        <td>Template Id</td>
        <td>Template Name</td>
        <td colspan="2">
            <form action="editorPortal.php" method="post">
                <input type="text" name="addCss" value="addCss" hidden />
                <input type="Submit" id="add" name="add" value="Add Template" />

            </form>
        </td>
    </tr>
    </thead>

    <tbody>
    <?php
    require("../Business/CssClass.php");

    $arrayOfCss = CssClass::retrieveTemplates();

    foreach($arrayOfCss as $css):

        ?>
        <tr>
            <td><?php echo $css->getId(); ?></td>
            <td><?php echo $css->getName(); ?></td>
            <td>
                <form action="" method="post">
                    <input type="text" id="editId" name="editId" value="<?php echo $css->getId(); ?>" hidden />
                    <input type="text" id="editId" name="editName" value="<?php echo $css->getName(); ?>" hidden />
                    <input type="Submit" id="editCss" name="editCss" value="Edit" />

                </form>
            </td>
            <td>
                <form action="" method="post">
                    <input type="text" id="delId" name="delId" value="<?php echo $css->getId(); ?>" hidden />
                    <input type="Submit" id="del" name="del" value="Delete" />

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>