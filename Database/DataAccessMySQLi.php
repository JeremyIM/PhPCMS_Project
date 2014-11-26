<?php


require_once '../Database/dbConn.php';

class DataAccessMySQLi extends dataAccess
{
    private $dbConnection;
    private $result;

    public function getDBConn()
    //FLAG this needs to be changed, connecting as root security FLAW!
    {
        $this->dbConnection = @new mysqli("localhost","root", "inet2005","mydb");
        if (!$this->dbConnection)
        {
            die('Could not connect to the Sakila Database: ' .
                $this->dbConnection->connect_errno);
        }
    }

    public function closeDBConn()
    {

        $this->dbConnection->close();
    }

    public function getPages()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM mydb.page");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }//end getPages

    public function getArticles()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM article");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }

    }//end getArticle


    public function getContent()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM content_area");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }

    }//end getContent

    public function getSinglePage($pageIDin)
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM mydb.page WHERE page_id='$pageIDin'");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }

    public function getAllArticle($pageIDin,$contentIDin)
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM article WHERE page_id='$pageIDin' AND content_area_id='$contentIDin'");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }


    //fetches

    public function fetchCssID($row)
    {
        return $row['css_id'];
    }
    public function fetchCssName($row)
    {
        return $row['name'];
    }
    public function fetchCssDescription($row)
    {
        return $row['description'];
    }
    public function fetchCssActiveStatus($row)
    {
        return $row['active_status'];
    }
    public function fetchCssStyleSnippet($row)
    {
        return $row['style_snippet'];
    }

    public function fetchPagePageId($row)
    {
        return $row['page_id'];
    }
    public function fetchPageName($row)
    {
        return $row['page_name'];
    }
    public function fetchPageWebName($row)
    {
        return $row['web_name'];
    }
    public function fetchPageDescription($row)
    {
        return $row['description'];
    }
    public function fetchPageActiveCss($row)
    {
        return $row['active_css'];
    }








}//end class DataAccessMySQLi
