<?php //TODO: Add Global Css Setting from Portal ?>

<h3>CSS Templates:</h3>
<table>
    <thead>
    <tr>
        <td>Template Id</td>
        <td>Template Name</td>
        <td colspan="2">
            <form action="editorPortal.php" method="post">
                <input type="Submit" id="addCss" name="addCss" value="Add Template" />

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
                <form action="editorPortal.php" method="post">
                    <input type="text" id="editCssId" name="editCssId" value="<?php echo $css->getId(); ?>" hidden />
                    <input type="Submit" id="editCss" name="editCss" value="Edit" />

                </form>
            </td>
            <td>
                <form action="editorPortal.php" method="post">
                    <input type="text" id="delCssId" name="delCssId" value="<?php echo $css->getId(); ?>" hidden />
                    <input type="Submit" id="delCss" name="delCss" value="Delete" />

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>