<?php

require_once '../Database/dbConn.php';

class ContentAreaClass
{
    //PROPERTIES
    private $contentId;
    private $contentName;
    private $divName;
    private $pgOrder;

    private $desc;
    private $creator;
    private $modBy;
    private $createDate;
    private $modDate;

    //CONSTRUCTOR
    public function __construct($name_in, $divName_in)
    {
        $this->contentName = $name_in;
        $this->divName = $divName_in;
    }//end constructor

    //GETTERS
    public function getId()
    {
        return $this->contentId;
    }
    public function getName()
    {
        return $this->contentName;
    }
    public function getDivName()
    {
        return $this->divName;
    }
    public function getOrder()
    {
        return $this->pgOrder;
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
        $this->contentId = $id_in;
    }
    public function setName($name_in)
    {
        $this->pageId = $name_in;
    }
    public function setDivName($divname_in)
    {
        $this->divName = $divname_in;
    }
    public function setOrder($order_in)
    {
        $this->pgOrder = $order_in;
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
    public function retrieveDivs()
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();

        $myDataAccess->getContentArea();

        while($row = $myDataAccess->fetchContentArea())
        {
            $currentDiv = new self($myDataAccess->fetchContentAreaName($row), $myDataAccess->fetchContentAreaDivName($row));
            $currentDiv->contentId = $myDataAccess->fetchContentAreaId($row);
            $currentDiv->pgOrder = $myDataAccess->fetchContentAreaPageOrder($row);
            $currentDiv->desc = $myDataAccess->fetchContentAreaDesc($row);
            $arrayOfDivObjects[] = $currentDiv;
        }

        $myDataAccess->closeDBConn();

        return $arrayOfDivObjects;
    }

    public function getSingleDiv($divIdIn)
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();

        $myDataAccess->getSingleDiv($divIdIn);

        $row = $myDataAccess->fetchContentArea();

        $currentDiv = new self($myDataAccess->fetchArticleName($row), $myDataAccess->fetchArticleTitle($row), $myDataAccess->fetchArticleContent($row));
        $currentDiv->contentId = $myDataAccess->fetchContentAreaId($row);
        $currentDiv->contentName = $myDataAccess->fetchContentAreaName($row);
        $currentDiv->divName = $myDataAccess->fetchContentAreaDivName($row);
        $currentDiv->pgOrder = $myDataAccess->fetchContentAreaPageOrder($row);
        $currentDiv->desc = $myDataAccess->fetchContentAreaDesc($row);


        $myDataAccess->closeDBConn();

        return $currentDiv;
    }

    public function saveDiv()
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();

        $rowsAffected = $myDataAccess->insertDiv($this->contentName
            ,$this->divName
            ,$this->pgOrder
            ,$this->desc);

        $myDataAccess->closeDBConn();

        return $rowsAffected . " row(s) Affected.";
    }

    public function deleteDiv()
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();

        $rowsAffected = $myDataAccess->deleteDiv($this->contentId);

        return $rowsAffected . " row(s) affected";
    }

    public function updateDiv()
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();

        $rowsAffected = $myDataAccess->updateDiv($this->contentId
            ,$this->contentName
            ,$this->divName
            ,$this->desc
            ,$this->pgOrder);

        $myDataAccess->closeDBConn();

        return $rowsAffected . " row(s) affected.";
    }



}//end page class
?>