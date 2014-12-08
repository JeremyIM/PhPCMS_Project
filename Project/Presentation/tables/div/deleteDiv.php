<h3>Delete Content Area</h3>
<?php
require '../Business/ContentAreaClass.php';

$currentDiv = ContentAreaClass::getSingleDiv($_POST['delDivId']);

?>
<p>
    Really delete Content Area #<?php echo $currentDiv->getId(); ?> : <?php echo $currentDiv->getName(); ?>?
</p>

<form action="editorPortal.php" method="post">
    <input type="text" id="delDivId" name="delDivId" value="<?php echo $currentDiv->getID(); ?>" hidden />
    <input type="Submit" id="deletedDiv" name="deletedDiv" value="Confirm Delete" />

</form>

