<?php //TODO: add conditional for header (add/edit) ?>

<h3>Edit Article:</h3>
<form action="editorPortal.php" method="post">


    <?php
    require("../Business/ArticleClass.php");
    require("../Business/PageClass.php");
    require("../Business/ContentAreaClass.php");

    $currentArticle = ArticleClass::getSingleArticle($_POST['editArticleId']);

    $arrayOfPages = PageClass::retrievePages();
    $arrayOfDivs = ContentAreaClass::retrieveDivs();


    //TODO: add code to preset pageOn and divIn selected option values (add vs edit?)

    ?>

    <table>
        <tr>
            <td>Article Title: </td>
            <td><input type="text" id="aTitle" name="aTitle" value="<?php echo $currentArticle->getTitle(); ?>" /></td>
        </tr>
        <tr>
            <td>Webname: </td>
            <td><input type="text" id="aWebName" name="aWebName" value="<?php echo $currentArticle->getWebName(); ?>" /></td>
        </tr>
        <tr>
            <td>Description: </td>
            <td><textarea id="aDesc" name="aDesc"><?php echo $currentArticle->getDesc(); ?></textarea></td>
        </tr>
        <tr>
            <td>Page Location: </td>
            <td>
                <select id="aPageOn" name="aPageOn">
                    <option value="all_pages">All Pages</option>
                    <?php foreach ($arrayOfPages as $page):?>
                        <option value="<?php echo $page->getId(); ?>"><?php echo $page->getPageTitle(); ?></option>
                    <?php endforeach; ?>
                    <option value="remove">Remove From All Pages</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Location on Page: </td>
            <td>
                <select id="aDivIn" name="aDivIn">
                    <?php foreach ($arrayOfDivs as $div):?>
                        <option value="<?php echo $div->getId(); ?>"><?php echo $div->getName(); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Content: </td>
            <td><textarea id="aContent" class="the_content" name="aContent"><?php echo $currentArticle->getContent(); ?></textarea></td>
        </tr>

        <tr>
            <?php if(isset($_POST['addArticle'])): ?>
                <td colspan="2"><input type="Submit" id="addedArticle" name="addedArticle" value="Add Article" /></td>
            <?php endif; ?>

            <?php if(isset($_POST['editArticleId'])): ?>
                <input type="text" id="editArticleId" name="editArticleId" value="<?php echo $_POST['editArticleId'] ?>" hidden />
                <td colspan="2"><input type="Submit" id="editedArticle" name="editedArticle" value="Update Article" /></td>
            <?php endif; ?>
        </tr>
    </table>
</form>