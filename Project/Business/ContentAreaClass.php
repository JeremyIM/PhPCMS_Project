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
    {}

    public function saveDiv()
    {}

    public function deleteDiv()
    {}

    public function updateDiv()
    {}

}//end page class
?>