<?php //TODO: add conditional for header (add/edit) ?>

<h3>Edit Page:</h3>
<form action="editorPortal.php" method="post">


    <?php

    require("../Business/PageClass.php");
    require("../Business/CssClass.php");

    $currentPage = PageClass::getSinglePage($_POST['editPageId']);

    $arrayOfTemplates = CssClass::retrieveTemplates();

    ?>

    <table>
        <tr>
            <td>Page Name: </td>
            <td><input type="text" id="pName" required name="pName" value="<?php echo $currentPage->getPageTitle(); ?>" /></td>
        </tr>
        <tr>
            <td>Webname: </td>
            <td><input type="text" id="pWebName" name="pWebName"  value="<?php echo $currentPage->getWebName(); ?>" /></td>
        </tr>
        <tr>
            <td>Description: </td>
            <td><textarea id="pDesc" name="pDesc"><?php echo $currentPage->getDesc(); ?></textarea></td>
        </tr>
        <tr>
            <td>Current Active Template: </td>
            <td>
                <select id="pCss" name="pCss">
                    <?php foreach ($arrayOfTemplates as $css):?>
                        <option value="<?php echo $css->getId(); ?>"><?php echo $css->getName(); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>


        <tr>
            <?php if(isset($_POST['addPage'])): ?>
                <td colspan="2"><input type="Submit" id="addedPage" name="addedPage" value="Add Page" /></td>
            <?php endif; ?>

            <?php if(isset($_POST['editPageId'])): ?>
                <input type="text" id="editPageId" name="editPageId" value="<?php echo $_POST['editPageId'] ?>" hidden />
                <td colspan="2"><input type="Submit" id="editedPage" name="editedPage" value="Update Page" /></td>
            <?php endif; ?>
        </tr>
    </table>
</form>