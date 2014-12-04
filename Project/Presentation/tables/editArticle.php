<h3>Edit Article:</h3>
<form action="" method="post">
    <?php

    require("../Business/ArticleClass.php");
    require("../Business/PageClass.php");
    require("../Business/ContentAreaClass.php");

    $currentArticle = ArticleClass::getSingleArticle($_POST['editArticleId']);
    $arrayOfPages = PageClass::retrievePages();
    $arrayOfDivs = ContentAreaClass::retrieveDivs();

    //TODO: add code to preset pageOn and divIn selected option values

    ?>


    <table>
        <tr>
            <td>Article Title: </td>
            <td><input type="text" id="title" name="title" value="<?php echo $currentArticle->getTitle(); ?>" /></td>
        </tr>
        <tr>
            <td>Webname: </td>
            <td><input type="text" id="webName" name="webName" value="<?php echo $currentArticle->getWebName(); ?>" /></td>
        </tr>
        <tr>
            <td>Description: </td>
            <td><textarea id="desc" name="desc"><?php echo $currentArticle->getDesc(); ?></textarea></td>
        </tr>
        <tr>
            <td>Page Location: </td>
            <td>
                <select id="pageOn" name="pageOn">
                    <option value="all_pages">All Pages</option>
                    <?php foreach ($arrayOfPages as $page):?>
                        <option value="<?php echo $page->getId(); ?>"><?php echo $page->getPageTitle(); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Location on Page: </td>
            <td>
                <select id="divIn" name="divIn">
                    <?php foreach ($arrayOfDivs as $div):?>
                        <option value="<?php echo $div->getId(); ?>"><?php echo $div->getName(); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Content: </td>
            <td><textarea id="theContent" name="theContent"><?php echo $currentArticle->getContent(); ?></textarea></td>
        </tr>

        <tr>
            <td colspan="2"><input type="Submit" id="add" name="add" value="Add Article" /></td>
        </tr>
    </table>
</form>