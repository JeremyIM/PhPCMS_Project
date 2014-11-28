<h3>Articles:</h3>
<table>
    <thead>
    <tr>
        <td>Article Id</td>
        <td>Article Name</td>
        <td></td>
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
                <form action="updateActor.php" method="post">
                    <input type="text" id="editId" name="editId" value="<?php echo $article->getID(); ?>" hidden />
                    <input type="text" id="editId" name="editTitle" value="<?php echo $article->getTitle(); ?>" hidden />
                    <input type="Submit" id="edit" name="edit" value="Edit" />

                </form>
            </td>
            <td>
                <form action="deleteActor.php" method="post">
                    <input type="text" id="delId" name="delId" value="<?php echo $article->getID(); ?>" hidden />
                    <input type="Submit" id="del" name="del" value="Delete" />

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>