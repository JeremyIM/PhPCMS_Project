<?php //TODO: add conditional for header (add/edit) ?>

<h3>Edit Content Area:</h3>
<form action="editorPortal.php" method="post">
    <?php

    require("../Business/ContentAreaClass.php");

    $currentDiv = ContentAreaClass::getSingleDiv($_POST['editDivId']);

    ?>

    <table>
        <tr>
            <td>Content Area name: </td>
            <td><input type="text" id="dName" name="dName" value="<?php echo $currentDiv->getName(); ?>" /></td>
        </tr>

        <tr>
            <td>Webname: </td>
            <td><input type="text" id="dDivName" name="dDivName" value="<?php echo $currentDiv->getDivName(); ?>" /></td>
        </tr>

        <tr>
            <td>Description: </td>
            <td><textarea id="aDesc" name="aDesc"><?php echo $currentDiv->getDesc(); ?></textarea></td>
        </tr>

        <tr>
            <td>Page Order: </td>
            <td><input type="number" id="dOrder" name="dOrder" value="<?php echo $currentDiv->getOrder(); ?>"min="1" max="10" /></td>
        </tr>

        <tr>
            <?php if(isset($_POST['addDiv'])): ?>
                <td colspan="2"><input type="Submit" id="addedDiv" name="addedDiv" value="Add Content Area" /></td>
            <?php endif; ?>

            <?php if(isset($_POST['editDivId'])): ?>
                <input type="text" id="editDivId" name="editDivId" value="<?php echo $_POST['editDivId'] ?>" hidden />
                <td colspan="2"><input type="Submit" id="editedDiv" name="editedDiv" value="Update Content Area" /></td>
            <?php endif; ?>
        </tr>

    </table>
</form>