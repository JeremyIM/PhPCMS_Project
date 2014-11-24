<?php

require_once '../Data/dbConn.php';

class PageClass
{
    private $pageId;
    private $pageTitle;
    private $pageWebName;
    private $activeCSS;

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
    public function setCSS($css_in)
    {
        $this->activeCSS = $css_in;
    }//enbd SETTERS



}//end page class
?>