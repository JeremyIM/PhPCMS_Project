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

    public abstract function getContentArea();

    public abstract function getCss();

    public abstract function getSinglePage($pageIDin);

    public abstract function getAreaArticles($pageIDin,$contentIDin);

    //CSS fetches
    public abstract function fetchCssID($row);

    public abstract function fetchCssName($row);

    public abstract function fetchCssDescription($row);

    public abstract function fetchCssActiveStatus($row);

    public abstract function fetchCssStyleSnippet($row);

    //Page Fetches
    public abstract function fetchPagePageId($row);

    public abstract function fetchPageName($row);

    public abstract function fetchPageWebName($row);

    public abstract function fetchPageDescription($row);

    public abstract function fetchPageActiveCss($row);

    //article fetches
    public abstract function fetchArticleID($row);
    public abstract function fetchArticleName($row);
    public abstract function fetchArticleTitle($row);
    public abstract function fetchArticleDesc($row);
    public abstract function fetchArticleAllPages($row);
    public abstract function fetchArticlePage($row);
    public abstract function fetchArticleContentArea($row);
    public abstract function fetchArticleContent($row);

    //Content area fetches
    public abstract function fetchContentAreaId($row);
    public abstract function fetchContentAreaName($row);
    public abstract function fetchContentAreaDivName($row);
    public abstract function fetchContentAreaPageOrder($row);
    public abstract function fetchContentAreaDesc($row);

    public abstract function getUsers();
    public abstract function fetchUsers();
    public abstract function fetchUUserID($row);
    public abstract function fetchUUserName($row);
    public abstract function fetchUUserFName($row);
    public abstract function fetchUUserLName($row);
    public abstract function fetchUWordPass($row);
    public abstract function fetchUCreator($row);
    public abstract function fetchUCreateDate($row);
    public abstract function fetchUModified($row);
    public abstract  function fetchUModDate($row);
    public abstract function getSingleUser($userID_in);
    public abstract function insertUser($username,$userFnameIn,$userLnameIn,$userPassword,$creatorIn);
    public abstract  function updateUserPriv($idIn,$permissionIn, $modID);





}//end dataAccess class