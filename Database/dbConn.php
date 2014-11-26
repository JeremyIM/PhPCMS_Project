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

    public abstract function getSinglePage($pageIDin);

    public abstract function getAllArticle($pageIDin,$contentIDin);

    public abstract function fetchCssID($row);

    public abstract function fetchCssName($row);

    public abstract function fetchCssDescription($row);

    public abstract function fetchCssActiveStatus($row);

    public abstract function fetchCssStyleSnippet($row);

    public abstract function fetchPagePageId($row);

    public abstract function fetchPageName($row);

    public abstract function fetchPageWebName($row);

    public abstract function fetchPageDescription($row);

    public abstract function fetchPageActiveCss($row);






}//end dataAccess class