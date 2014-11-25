<?php

 require_once '../Database/DataAccessMySQLi.php';

abstract class dataAccess
{
    private static $m_DataAccess;

    public static function getInstance()
    {
        if(self::$m_DataAccess == null)
        {
            self::$m_DataAccess = new DataAccessMySQLi();
        }
        return self::$m_DataAccess;
    }//end getInstance

    public abstract function getDBConn();

    public abstract function closeDBConn();

    // get statements!

    public abstract function getPages();

    public abstract function getArticles();

    public abstract function getContent();





}//end dataAccess class