<h3>Delete Page</h3>
<?php
require '../Business/PageClass.php';

$currentPage = PageClass::getSinglePage($_POST['delPageId']);

?>
<p>
    Really delete Page #<?php echo $currentPage->getId(); ?> : <?php echo $currentPage->getPageTitle(); ?>?
</p>

<form action="editorPortal.php" method="post">
    <input type="text" id="delPageId" name="delPageId" value="<?php echo $currentPage->getID(); ?>" hidden />
    <input type="Submit" id="deletedPage" name="deletedPage" value="Confirm Delete" />

</form>

