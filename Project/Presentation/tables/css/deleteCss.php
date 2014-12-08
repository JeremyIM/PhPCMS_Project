<h3>Delete Template</h3>
<?php
require '../Business/CssClass.php';

$currentCss = CssClass::getSingleTemplate($_POST['delCssId']);

?>
<p>
    Really delete Template #<?php echo $currentCss->getId(); ?> : <?php echo $currentCss->getName(); ?>?
</p>

<form action="editorPortal.php" method="post">
    <input type="text" id="delCssId" name="delCssId" value="<?php echo $currentCss->getID(); ?>" hidden />
    <input type="Submit" id="deletedCss" name="deletedCss" value="Confirm Delete" />

</form>

