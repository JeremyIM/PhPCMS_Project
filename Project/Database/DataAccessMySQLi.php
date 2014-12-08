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
        return $this->result->fetch_array();

    }//end getPages

    public function getArticles()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM article");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();

    }//end getArticle

    public function getAreaArticles($pageIdIn, $contentIDin)
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM article WHERE (page_id='$pageIdIn' or all_pages=1) and content_area_id='$contentIDin'");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }
    public function getContentArea()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM content_area");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();

    }//end getContent

    public function getCss()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM css");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();

    }//end getContent

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
        return $row['active_css'];//article fetches
    }
        public function fetchArticleID($row)
    {
        return $row['article_id'];
    }
        public function fetchArticleName($row)
    {
        return $row['name'];
    }
        public function fetchArticleTitle($row)
    {
        return $row['title'];
    }
        public function fetchArticleDesc($row)
    {
        return $row['description'];
    }
        public function fetchArticleAllPages($row)
    {
        return $row['all_pages'];
    }
        public function fetchArticlePage($row)
    {
        return $row['page_id'];
    }
        public function fetchArticleContentArea($row)
    {
        return $row['content_area_id'];
    }
        public function fetchArticleContent($row)
    {
        return $row['the_content'];
    }

        //Content area fetches
        public function fetchContentAreaId($row)
    {
        return $row['content_id'];
    }
        public function fetchContentAreaName($row)
    {
        return $row['name'];
    }
        public function fetchContentAreaDivName($row)
    {
        return $row['div_name'];
    }
        public function fetchContentAreaPageOrder($row)
    {
        return $row['page_order_pos'];
    }
        public function fetchContentAreaDesc($row)
    {
        return $row['description'];
    }




    //add'l selects
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

/////////// ** USER SQL QUERIES ** ///////////////////
// GET + FETCH
    public function getUsers()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM user");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }//end getPages
    public function fetchUsers()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }
    public function getSingleUser($userID_in)
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM user WHERE user_id='$userID_in'");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }
    public function updateUser($idIn, $usernameIn, $FnameIn, $LnameIn, $wordPassIn,$permissionIn) //$modID) // This needs to be added when logins are better setup
    {
        $updateSql = "UPDATE user SET ";
        $updateSql .= "username='" .$usernameIn . "',";
        $updateSql .= "first_name='" . $FnameIn . "',";
        $updateSql .= "last_name='" . $LnameIn . "',";
        $updateSql .= "password='" . $wordPassIn. "',";
        $updateSql .= "permissions_id='" . $permissionIn. "',";
        $updateSql .= "last_modified_date=NOW()";
        $updateSql .= "WHERE user_id=" . $idIn;
        $this->result =@$this->dbConnection->query($updateSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }
    public function updateUserPriv($idIn,$permissionIn) //$modID) // This needs to be added when logins are better setup
    {
        $updateSql = "UPDATE user SET ";
        $updateSql .= "permissions_id='" . $permissionIn. "',";
        $updateSql .= "last_modified_date=NOW()";
        $updateSql .= "WHERE user_id=" . $idIn;
        $this->result =@$this->dbConnection->query($updateSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }
    public function insertUser($usernameIn,$userFnameIn,$userLnameIn,$userPassword) //Creator ID still needs to be added!
    {
        $this->result =@$this->dbConnection->query("SELECT user_id FROM user");
        $rowcount=(mysqli_num_rows($this->result)+1);
        $this->result =@$this->dbConnection->query("INSERT INTO user (user_id,username,first_name,last_name,password,created_date)
VALUES ('$rowcount','$usernameIn','$userFnameIn','$userLnameIn','$userPassword', NOW())");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }
    public function deleteUser($idIn)
    {
        $deleteSql = "DELETE from user WHERE user_id='$idIn'";
        $this->result =@$this->dbConnection->query($deleteSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }
    public function fetchUUserID($row)
    {
        return $row['user_id'];
    }
    public function fetchUUserName($row)
    {
        return $row['username'];
    }
    public function fetchUUserFName($row)
    {
        return $row['first_name'];
    }
    public function fetchUUserLName($row)
    {
        return $row['last_name'];
    }
    public function fetchUWordPass($row)
    {
        return $row['password'];
    }
    public function fetchUCreator($row)
    {
        return $row['created_by_id'];
    }
    public function fetchUCreateDate($row)
    {
        return $row['created_date'];
    }
    public function fetchUModified($row)
    {
        return $row['modified_by_id'];
    }
    public function fetchUModDate($row)
    {
        return $row['last_modified_date'];
    }
    public function fetchUPermission($row)
    {
        return $row['permissions_id'];
    }
}//end class DataAccessMySQLi
