<?php //TODO: add conditional for header (add/edit) ?>

<h3>Edit Page:</h3>
<form action="editorPortal.php" method="post">


    <?php

    require("../Business/PageClass.php");
    require("../Business/CssClass.php");

    $currentCss = CssClass::getSingleTemplate($_POST['editCssId']);

    //TODO: add reading of whether currently active for select input
    ?>

    <table>
        <tr>
            <td>Template Name: </td>
            <td><input type="text" id="cName" name="cName" value="<?php echo $currentCss->getName(); ?>" /></td>
        </tr>

        <tr>
            <td>Description: </td>
            <td><textarea id="cDesc" name="cDesc">
                    <?php echo $currentCss->getDesc(); ?>
                </textarea>
            </td>
        </tr>

        <tr>
            <td>Set as Active Style: </td>
            <td>
                <select id="cActive" name="cActive">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>CSS: </td>
            <td><textarea id="cContent" name="cContent">
                    <?php echo $currentCss->getContent(); ?>
                </textarea>
            </td>
        </tr>


        <tr>
            <?php if(isset($_POST['addCss'])): ?>
                <td colspan="2"><input type="Submit" id="addedCss" name="addedCss" value="Add Template" /></td>
            <?php endif; ?>

            <?php if(isset($_POST['editCssId'])): ?>
                <input type="text" id="editCssId" name="editCssId" value="<?php echo $_POST['editCssId'] ?>" hidden />
                <td colspan="2"><input type="Submit" id="editedCss" name="editedCss" value="Update Template" /></td>
            <?php endif; ?>
        </tr>
    </table>
</form>