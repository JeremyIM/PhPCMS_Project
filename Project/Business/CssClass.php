<?php

require_once '../Database/dbConn.php';

class CssClass
{
    //PROPERTIES
    private $cssId;
    private $cssName;
    private $desc;
    private $active;
    private $creator;
    private $modBy;
    private $createDate;
    private $modDate;
    private $theContent;

    //CONSTRUCTOR
    public function __construct($name_in, $content_in)
    {
        $this->cssName = $name_in;
        $this->theContent = $content_in;
    }

    //GETTERS
    public function getId(){
        return $this->cssId;
    }
    public function getName(){
        return $this->cssName;
    }
    public function getDesc(){
        return $this->desc;
    }
    public function getActive(){
        return $this->active;
    }
    public function getCreator(){
        return $this->creator;
    }
    public function getModBy(){
        return $this->modBy;
    }
    public function getCreateDate(){
        return $this->createDate;
    }
    public function getModDate(){
        return $this->modDate;
    }
    public function getContent(){
        return $this->theContent;
    }

    //SETTERS
    public function setId($id_in){
        $this->cssId = $id_in;
    }
    public function setName($name_in){
        $this->cssName = $name_in;
    }
    public function setDesc($desc_in){
        $this->desc = $desc_in;
    }
    public function setActive($active_in){
        $this->active = $active_in;
    }
    public function setCreator($creator_in){
        $this->creator = $creator_in;
    }
    public function setModBy($mod_in){
        $this->modBy = $mod_in;
    }
    public function setCreateDate($cDate_in){
        $this->createDate = $cDate_in;
    }
    public function setModDate($mDate_in){
        $this->modDate = $mDate_in;
    }
    public function setContent($content_in){
        $this->theContent = $content_in;
    }

    //CRUD FUNCTIONS
    public function retrieveTemplates()
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();

        //$myDataAccess->getPages();

        while($row = $myDataAccess->getCss())
        {
            $currentCss = new self($myDataAccess->fetchCssName($row), $myDataAccess->fetchCssStyleSnippet($row));
            $currentCss->desc = $myDataAccess->fetchCssDescription($row);
            $currentCss->active = $myDataAccess->fetchCssActiveStatus($row);

            $arrayOfCssObjects[] = $currentCss;
        }

        $myDataAccess->closeDBConn();

        return $arrayOfCssObjects;
    }

    public function saveTemplate()
    {}

    public function deleteTemplate()
    {}

    public function updateTemplate()
    {}
}