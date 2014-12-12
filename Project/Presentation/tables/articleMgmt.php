<h3>Articles:</h3>
<table>
    <thead>
    <tr>
        <td>Article Id</td>
        <td>Article Name</td>
        <td>On Page &#35;</td>
        <td>Content Area In</td>
        <td colspan="2">
            <form action="editorPortal.php" method="post">
                <input type="Submit" id="addArticle" name="addArticle" value="Add Article" />
            </form>
        </td>
    </tr>
    </thead>
    <tbody>
    <?php
    require("../Business/ArticleClass.php");
    require("../Business/ContentAreaClass.php");
    require("../Business/PageClass.php");

    $arrayOfArticles = ArticleClass::retrieveArticles();


    foreach($arrayOfArticles as $article):
        $div = ContentAreaClass::getSingleDiv($article->getDivContainer());
        $page = PageClass::getSinglePage($article->getPageOnId())

        ?>
        <tr>
            <td><?php echo $article->getId(); ?></td>
            <td><?php echo $article->getTitle(); ?></td>
            <td>
                <?php
                    if($article->getPageOnId() > 0)
                        echo $page->getPageTitle();
                        //echo $article->getPageOnId();
                    elseif($article->getAllPages() == true)
                        echo "All Pages";
                    else
                        echo "None";
                ?>
            </td>
            <td><?php echo $div->getName();?>
            </td>
            <td>
                <form action="editorPortal.php" method="post">
                    <input type="text" id="editArticleId" name="editArticleId" value="<?php echo $article->getID(); ?>" hidden /><input type="text" id="editId" name="editArticleTitle" value="<?php echo $article->getTitle(); ?>" hidden />
                    <input type="Submit" id="editArticle" name="editArticle" value="Edit" />

                </form>
            </td>
            <td>
                <form action="editorPortal.php" method="post">
                    <input type="text" id="delArticleId" name="delArticleId" value="<?php echo $article->getID(); ?>" hidden />
                    <input type="Submit" id="delArticle" name="delArticle" value="Delete" />

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>