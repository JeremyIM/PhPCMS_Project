<h3>Delete Article</h3>
<?php
require '../Business/UserClass.php';

$currentUser = UserClass::get($_POST['delArticleId']);

?>
<p>
    Really delete Article #<?php echo $currentArticle->getId(); ?> : <?php echo $currentArticle->getTitle(); ?>?
</p>

<form action="editorPortal.php" method="post">
    <input type="text" id="delArticleId" name="delArticleId" value="<?php echo $currentArticle->getID(); ?>" hidden />
    <input type="Submit" id="deletedArticle" name="deletedArticle" value="Confirm Delete" />

</form>

