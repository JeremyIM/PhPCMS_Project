<?php

require_once '../Database/dbConn.php';

class ArticleClass
{
    //PROPERTIES
    private $articleId;
    private $articleWebName;
    private $articleTitle;
    private $desc;
    private $allPages;
    private $pageOn;
    private $divContainer;
    private $theContent;

    private $creator;
    private $modBy;
    private $createDate;
    private $modDate;

    //CONSTRUCTOR
    public function __construct($webName_in, $title_in, $content_in)
    {
        $this->articleWebName = $webName_in;
        $this->articleTitle = $title_in;
        $this->theContent = $content_in;
    }//end CONSTRUCTOR

    //GETTERS
    public function getId()
    {
        return $this->articleId;
    }
    public function getWebName()
    {
        return $this->articleWebName;
    }
    public function getTitle()
    {
        return $this->articleTitle;
    }
    public function getAllPages()
    {
        return $this->allPages;
    }
    public function getPageOnId()
    {
        return $this->pageOn;
    }
    public function getDivContainer()
    {
        return $this->divContainer;
    }
    public function getContent()
    {
        return $this->theContent;
    }
    public function getDesc()
    {
        return $this->desc;
    }
    public function getCreator()
    {
        return $this->creator;
    }
    public function getModBy()
    {
        return $this->modBy;
    }
    public function createDate()
    {
        return $this->createDate;
    }
    public function getModDate()
    {
        return $this->modDate;
    }//end GETTERS

    //SETTERS
    public function setId($id_in)
    {
        $this->articleId = $id_in;
    }
    public function setWebName($name_in)
    {
        $this->articleWebName = $name_in;
    }
    public function setTitle($title_in)
    {
        $this->articleTitle = $title_in;
    }
    public function setAllPagesBool($allPages_in)
    {
        $this->allPages = $allPages_in;
    }
    public function setPageOn($pageOn_in)
    {
        $this->pageOn = $pageOn_in;
    }
    public function setDivContainer($div_in)
    {
        $this->divContainer = $div_in;
    }
    public function setContent($content_in)
    {
        $this->theContent = $content_in;
    }
    public function setDesc($desc_in)
    {
        $this->desc = $desc_in;
    }
    public function setCreator($creator_in)
    {
        $this->creator= $creator_in;
    }
    public function setModBy($mod_in)
    {
        $this->modBy = $mod_in;
    }
    public function setCreateDate($cDate_in)
    {
        $this->createDate = $cDate_in;
    }
    public function setModDate($mDate_in)
    {
        $this->modDate = $mDate_in;
    }//end SETTERS

    //CRUD FUNCTIONS
    public function retrieveArticles()
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();

        $myDataAccess->getArticles();

        while($row = $myDataAccess->fetchArticles())
        {
            $currentArticle = new self($myDataAccess->fetchArticleName($row), $myDataAccess->fetchArticleTitle($row), $myDataAccess->fetchArticleContent($row));
            $currentArticle->articleId = $myDataAccess->fetchArticleID($row);
            $currentArticle->desc = $myDataAccess->fetchArticleDesc($row);
            $currentArticle->allPages = $myDataAccess->fetchArticleAllPages($row);
            $currentArticle->pageOn = $myDataAccess->fetchArticlePage($row);
            $currentArticle->divContainer = $myDataAccess->fetchArticleContentArea($row);
            $arrayOfArticleObjects[] = $currentArticle;
        }

        $myDataAccess->closeDBConn();

        return $arrayOfArticleObjects;
    }

    public function saveArticle()
    {}

    public function deleteArticle()
    {}

    public function updateArticle()
    {}

    public function getAnArticle($pageIdIn, $contentIdIn)
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();

        $myDataAccess->getAnArticle($pageIdIn, $contentIdIn);

        while($row = $myDataAccess->fetchArticles())
        {
            $currentArticle = new self($myDataAccess->fetchArticleName($row), $myDataAccess->fetchArticleTitle($row), $myDataAccess->fetchArticleContent($row));
            $currentArticle->articleId = $myDataAccess->fetchArticleID($row);
            $currentArticle->desc = $myDataAccess->fetchArticleDesc($row);
            $currentArticle->allPages = $myDataAccess->fetchArticleAllPages($row);
            $currentArticle->pageOn = $myDataAccess->fetchArticlePage($row);
            $currentArticle->divContainer = $myDataAccess->fetchArticleContentArea($row);
            $arrayOfArticleObjects[] = $currentArticle;
        }
        $myDataAccess->closeDBConn();
        return $arrayOfArticleObjects;
    }


}//end page class
?>