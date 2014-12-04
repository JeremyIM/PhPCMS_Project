<h3>Articles:</h3>
<table>
    <thead>
    <tr>
        <td>Article Id</td>
        <td>Article Name</td>
        <td colspan="2">
            <form action="../Presentation/editorPortal.php" method="post">
                <input type="text" name="addArticle" value="addArticle" hidden />
                <input type="Submit" id="add" name="add" value="Add Article" />

            </form>
        </td>
    </tr>
    </thead>
    <tbody>
    <?php
    require("../Business/ArticleClass.php");

    $arrayOfArticles = ArticleClass::retrieveArticles();

    foreach($arrayOfArticles as $article):

        ?>
        <tr>
            <td><?php echo $article->getId(); ?></td>
            <td><?php echo $article->getTitle(); ?></td>
            <td>
                <form action="editorPortal.php" method="post">
                    <input type="text" id="editArticleId" name="editArticleId" value="<?php echo $article->getID(); ?>" hidden /><input type="text" id="editId" name="editArticleTitle" value="<?php echo $article->getTitle(); ?>" hidden />
                    <input type="Submit" id="editArticle" name="editArticle" value="Edit" />

                </form>
            </td>
            <td>
                <form action="deleteArticle.php" method="post">
                    <input type="text" id="delArticleId" name="delArticleId" value="<?php echo $article->getID(); ?>" hidden />
                    <input type="Submit" id="delArticle" name="delArticle" value="Delete" />

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>