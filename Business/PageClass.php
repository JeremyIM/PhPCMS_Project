<?php

require_once '../Database/dbConn.php';

class PageClass
{
    //PROPERTIES
    private $pageId;
    private $pageTitle;
    private $pageWebName;

    private $desc;
    private $creator;
    private $modBy;
    private $createDate;
    private $modDate;

    private $activeCSS;


    //CONSTRUCTOR
    public function __construct($title_in, $webName_in)
    {
        $this->pageTitle = $title_in;
        $this->pageWebName = $webName_in;

    }//end constructor

    //GETTERS
    public function getId()
    {
        return $this->pageId;
    }
    public function getPageTitle()
    {
        return $this->pageTitle;
    }
    public function getWebName()
    {
        return $this->pageWebName;
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
    public function getCreateDate()
    {
        return $this->createDate;
    }
    public function getModDate()
    {
        return $this->modDate;
    }
    public function getCSS()
    {
        return $this->activeCSS;
    }//end GETTERS


    //SETTERS
    public function setId($id_in)
    {
        $this->pageId = $id_in;
    }
    public function setPageTitle($title_in)
    {
        $this->pageTitle = $title_in;
    }
    public function setWebName($webName_in)
    {
        $this->pageWebName = $webName_in;
    }
    public function setDesc($desc_in)
    {
        $this->desc = $desc_in;
    }
    public function setCreator($creator_in)
    {
        $this->creator = $creator_in;
    }
    public function setModBy($modBy_in)
    {
        $this->modBy = $modBy_in;
    }
    public function setCreateDate($cDate_in)
    {
        $this->createDate = $cDate_in;
    }
    public function setModDate($mDate_in)
    {
        $this->modDate = $mDate_in;
    }
    public function setCSS($css_in)
    {
        $this->activeCSS = $css_in;
    }//enbd SETTERS


    //CRUD FUNCTIONS
    public static function retrievePages()
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();

        $myDataAccess->getPages();

        while($row = $myDataAccess->fetchPages())
        {
            $currentPage = new self($myDataAccess->fetchPageName($row), $myDataAccess->fetchPageWebName($row));
            $currentPage->pageId = $myDataAccess->fetchPagePageId($row);
            $currentPage->desc = $myDataAccess->fetchPageDescription($row);
            $currentPage->activeCSS = $myDataAccess->fetchPageActiveCss($row);
            $arrayOfPageObjects[] = $currentPage;
        }

        $myDataAccess->closeDBConn();

        return $arrayOfPageObjects;
    }

    public function savePage()
    {}

    public function deletePage()
    {}

    public function updatePage()
    {}

    public function getSinglePage($pageIdIn)
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();

        $myDataAccess->getSinglePage($pageIdIn);

        while($row = $myDataAccess->fetchPages())
        {
            $currentPage = new self($myDataAccess->fetchPageName($row), $myDataAccess->fetchPageWebName($row));
            $currentPage->pageId = $myDataAccess->fetchPagePageId($row);
            $currentPage->desc = $myDataAccess->fetchPageDescription($row);
            $currentPage->activeCSS = $myDataAccess->fetchPageActiveCss($row);
          //  $arrayOfPageObjects[] = $currentPage;
        }
        $myDataAccess->closeDBConn();
        return $currentPage;


    }

}//end page class
?>