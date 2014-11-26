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


    public function getContentArea()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM content_area");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }

    }//end getContent

    public function getCss()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM css");
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




}//end class DataAccessMySQLi
