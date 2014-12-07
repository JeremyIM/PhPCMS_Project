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
/////////////////////////////////////////////////////////////
    public function getPages()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM mydb.page");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }

    }//end getPages

    public function fetchPages()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }

    public function insertPage($nameIn, $webNameIn,$descIn, $cssIn)
    {
        $sqlInsert = "INSERT INTO mydb.page (page_name, web_name, description, active_css) VALUES('$nameIn', '$webNameIn', '$descIn', '$cssIn')";


        $this->result =@$this->dbConnection->query($sqlInsert);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }

    public function updatePage($idIn, $nameIn, $webNameIn, $descIn, $cssIn)
    {
        $updateSql = "UPDATE mydb.page SET ";
        $updateSql .= "page_name='" . $nameIn . "',";
        $updateSql .= "web_name='" . $webNameIn . "',";
        $updateSql .= "description='" . $descIn . "',";
        $updateSql .= "active_css='" . $cssIn;
        $updateSql .= "' WHERE page_id=" . $idIn;

        $this->result =@$this->dbConnection->query($updateSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }

    public function deletePage($idIn)
    {
        $deleteSql = "DELETE from page WHERE page_id='$idIn'";

        $this->result =@$this->dbConnection->query($deleteSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;

    }

    //////////////////////////////////////////////////////////////////////



    public function getArticles()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM article");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }

    }//end getArticle

    public function fetchArticles()
    {

        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();

    }

    public function insertArticle($nameIn, $titleIn, $descIn, $pageIn, $allIn, $divIn, $contentIn)
    {
        $sqlInsert = "INSERT INTO article (name, title, description,";
        if($allIn == 0)
            $sqlInsert .= "page_id, ";
        $sqlInsert .= "all_pages, content_area_id, the_content) VALUES('";
        $sqlInsert .=$nameIn ."', '";
        $sqlInsert .= $titleIn . "', '";
        $sqlInsert .= $descIn . "', '";
        if($allIn == 0)
            $sqlInsert .= $pageIn . "', '";
        $sqlInsert .= $allIn . "' , '";
        $sqlInsert .= $divIn . "', '" ;
        $sqlInsert .= $contentIn . "')";

        $this->result =@$this->dbConnection->query($sqlInsert);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }

    public function updateArticle($idIn, $nameIn, $titleIn, $descIn, $pageIn, $allIn, $divIn, $contentIn)
    {
        $updateSql = "UPDATE article SET ";
        $updateSql .= "name='" . $nameIn . "',";
        $updateSql .= "title='" . $titleIn . "',";
        $updateSql .= "description='" . $descIn . "',";

        if($allIn == 0)
            $updateSql .= "page_id='" . $pageIn . "',";

        $updateSql .= "all_pages='" . $allIn . "',";
        $updateSql .= "content_area_id='" . $divIn . "',";
        $updateSql .= "the_content='" . $contentIn . "' ";
        $updateSql .= "WHERE article_id=" . $idIn;

        $this->result =@$this->dbConnection->query($updateSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }

    public function deleteArticle($idIn)
    {
        $deleteSql = "DELETE from article WHERE article_id='$idIn'";

        $this->result =@$this->dbConnection->query($deleteSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;

    }



////////////////////////////////////////////////////

    public function getContentArea()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM content_area");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }

    }//end getPages

    public function fetchContentArea()
    {

        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();

    }

    public function insertDiv($nameIn, $divNameIn, $orderIn, $descIn)
    {
        $sqlInsert = "INSERT INTO content_area (name, div_name, page_order_pos, description) VALUES('$nameIn', '$divNameIn', '$orderIn', '$descIn')";


        $this->result =@$this->dbConnection->query($sqlInsert);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }

    public function updateDiv($idIn, $nameIn, $divNameIn, $descIn, $orderIn)
    {
        $updateSql = "UPDATE content_area SET ";
        $updateSql .= "name='" . $nameIn . "',";
        $updateSql .= "div_name='" . $divNameIn . "',";
        $updateSql .= "description='" . $descIn . "',";
        $updateSql .= "page_order_pos='" . $orderIn;
        $updateSql .= "' WHERE content_id=" . $idIn;

        $this->result =@$this->dbConnection->query($updateSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }

    public function deleteDiv($idIn)
    {
        $deleteSql = "DELETE from content_area WHERE content_id='$idIn'";

        $this->result =@$this->dbConnection->query($deleteSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;

    }

    ///////////////////////////////////////////////////

    public function getCss()
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM css");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }

    }//end getContent

    public function fetchCss()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }

    public function insertCss($nameIn,$descIn, $activeIn, $contentIn)
    {
        $sqlInsert = "INSERT INTO css (name, description, active_status, style_snippet) VALUES('$nameIn', '$descIn', '$activeIn', '$contentIn')";


        $this->result =@$this->dbConnection->query($sqlInsert);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }

    public function updateCss($idIn, $nameIn, $descIn, $activeIn, $contentIn)
    {
        $updateSql = "UPDATE css SET ";
        $updateSql .= "name='" . $nameIn . "',";
        $updateSql .= "description='" . $descIn . "',";
        $updateSql .= "active_status='" . $activeIn . "',";
        $updateSql .= "style_snippet='" . $contentIn;
        $updateSql .= "' WHERE css_id=" . $idIn;

        $this->result =@$this->dbConnection->query($updateSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;
    }

    public function deleteCss($idIn)
    {
        $deleteSql = "DELETE from css WHERE css_id='$idIn'";

        $this->result =@$this->dbConnection->query($deleteSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
        return $this->dbConnection->affected_rows;

    }/////////// ** USER SQL QUERIES ** ///////////////////
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
    public function updateUser($idIn, $usernameIn, $FnameIn, $LnameIn, $wordPassIn) //$modID) // This needs to be added when logins are better setup
    {
        $updateSql = "UPDATE user SET ";
        $updateSql .= "username='" .$usernameIn  . "',";
        $updateSql .= "first_name='" . $FnameIn . "',";
        $updateSql .= "last_name='" . $LnameIn . "',";
        $updateSql .= "password='" . $wordPassIn. "',";
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

    public function checkUserLogin($userIn, $pwIn)
    {
        $sql = "SELECT * FROM user WHERE username='";
        $sql.= $userIn . "' AND password='";
        $sql.= $pwIn . "';";
        $this->result =@$this->dbConnection->query($sql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }

    //USER FETCHES
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




    ///////////////////////////////////////////////////////////////

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
        $this->result =@$this->dbConnection->query("SELECT * FROM page WHERE page_id='$pageIDin'");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }

    public function getAreaArticles($pageIdIn, $contentIDin)
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM article WHERE (page_id='$pageIdIn' or all_pages=1) and content_area_id='$contentIDin'");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }

    public function getSingleArticle($articleIdIn)
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM article WHERE article_id='$articleIdIn'");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }

    public function getSingleCss($cssIdIn)
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM css WHERE css_id='$cssIdIn'");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }

    public function getSingleDiv($divIdIn)
    {
        $this->result =@$this->dbConnection->query("SELECT * FROM content_area WHERE content_id='$divIdIn'");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }



}//end class DataAccessMySQLi
