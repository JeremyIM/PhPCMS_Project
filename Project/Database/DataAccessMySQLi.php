<?php
require_once '../Database/dbConn.php';

class DataAccessMySQLi extends dataAccess
{
    private $dbConnectionAdmin;
    private $dbConnectionEditor;
    private $dbConnectionAuthor;
    private $dbConnection;
    private $result;

/////////////////////////////////////////////////////////////
//-------------------DATABASE CONN----------------------------
/////////////////////////////////////////////////////////////

    public function getDBConn()
        //FLAG this needs to be changed, connecting as root security FLAW!
    {
        if($_SESSION['permission']=="admin")
        {$this->dbConnectionAdmin = @new mysqli("localhost","Admin", "Admin2005","mydb");}
        if($_SESSION['permission']=="editor")
        {$this->dbConnectionEditor = @new mysqli("localhost","Editor", "Editor2005","mydb");}
        if($_SESSION['permission']=="author")
        {$this->dbConnectionAuthor = @new mysqli("localhost","Author", "Author2005","mydb");}
        if(!isset($_SESSION['permission']))
        {$this->dbConnection = @new mysqli("localhost","Browse", "Browse2005","mydb");}

        if (!$this->dbConnectionAdmin && !$this->dbConnectionEditor && !$this->dbConnectionAuthor && !$this->dbConnection)
        {
            die('Could not connect to the Sakila Database: ' .
                $this->dbConnection->connect_errno);
        }
    }

    public function closeDBConn()
    {

        if($_SESSION['permission']=="admin")
        {$this->dbConnectionAdmin->close();}
        if($_SESSION['permission']=="editor")
        {$this->dbConnectionEditor->close();}
        if($_SESSION['permission']=="author")
        {$this->dbConnectionAuthor->close();}
        if(!isset($_SESSION['permission']))
        {$this->dbConnection->close();}
    }

/////////////////////////////////////////////////////////////
//-------------------PAGES SQL----------------------------
/////////////////////////////////////////////////////////////

    public function getPages()
    {
        if($_SESSION['permission']=="admin")
        {
        $this->result =@$this->dbConnectionAdmin->query("SELECT * FROM mydb.page");
        }
        if($_SESSION['permission']=="editor")
        {
        $this->result =@$this->dbConnectionEditor->query("SELECT * FROM mydb.page");
        }
        if($_SESSION['permission']=="author")
        {
        $this->result =@$this->dbConnectionAuthor->query("SELECT * FROM mydb.page");
        }
        if(!isset($_SESSION['permission']))
        {
        $this->result =@$this->dbConnection->query("SELECT * FROM mydb.page");
        }
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

    public function getSinglePage($pageIDin)
    {
        if($_SESSION['permission']=="admin")
        {
            $spageIDin= mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($pageIDin));
            $this->result =@$this->dbConnectionAdmin->query("SELECT * FROM page WHERE page_id='$spageIDin'");
        }
        if($_SESSION['permission']=="editor")
        {
            $spageIDin= mysqli_real_escape_string($this->dbConnectionEditor, stripslashes($pageIDin));
            $this->result =@$this->dbConnectionEditor->query("SELECT * FROM page WHERE page_id='$spageIDin'");
        }
        if($_SESSION['permission']=="author")
        {
            $spageIDin= mysqli_real_escape_string($this->dbConnectionAuthor, stripslashes($pageIDin));
            $this->result =@$this->dbConnectionAuthor->query("SELECT * FROM page WHERE page_id='$spageIDin'");
        }
        if(!isset($_SESSION['permission']))
        {
            $spageIDin= mysqli_real_escape_string($this->dbConnection, stripslashes($pageIDin));
            $this->result =@$this->dbConnection->query("SELECT * FROM page WHERE page_id='$spageIDin'");
        }
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }

    public function insertPage($nameIn, $webNameIn,$descIn, $cssIn,$creatorIn)
    {
        $sName = mysqli_real_escape_string($this->dbConnectionEditor, $nameIn);
        $sWebname = mysqli_real_escape_string($this->dbConnectionEditor, $webNameIn);
        $sDesc = mysqli_real_escape_string($this->dbConnectionEditor, $descIn);
        $sCss = mysqli_real_escape_string($this->dbConnectionEditor, $cssIn);
        $sCreator = mysqli_real_escape_string($this->dbConnectionEditor, $creatorIn);

        $sqlInsert =    "INSERT INTO mydb.page (page_name, web_name, description, active_css, created_date,created_by_id)
                        VALUES('$sName', '$sWebname', '$sDesc', '$sCss', NOW(),'$sCreator')";


        $this->result =@$this->dbConnectionEditor->query($sqlInsert);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionEditor->error);
        }
        return $this->dbConnectionEditor->affected_rows;
    }

    public function updatePage($idIn, $nameIn, $webNameIn, $descIn, $cssIn, $creatorIn)
    {
        $sId = mysqli_real_escape_string($this->dbConnectionEditor, $idIn);
        $sName = mysqli_real_escape_string($this->dbConnectionEditor, $nameIn);
        $sWebname = mysqli_real_escape_string($this->dbConnectionEditor, $webNameIn);
        $sDesc = mysqli_real_escape_string($this->dbConnectionEditor, $descIn);
        $sCss = mysqli_real_escape_string($this->dbConnectionEditor, $cssIn);
        $sCreator = mysqli_real_escape_string($this->dbConnectionEditor, $creatorIn);


        $updateSql = "UPDATE mydb.page SET ";
        $updateSql .= "page_name='" . $sName . "',";
        $updateSql .= "web_name='" . $sWebname . "',";
        $updateSql .= "description='" . $sDesc . "',";
        $updateSql .= "active_css='" . $sCss . "',";
        $updateSql .= "modified_by_id='" . $sCreator . "',";
        $updateSql .= "modified_date=NOW()";
        $updateSql .= " WHERE page_id=" . $sId;

        $this->result =@$this->dbConnectionEditor->query($updateSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionEditor->error);
        }
        return $this->dbConnectionEditor->affected_rows;
    }

    public function deletePage($idIn)
    {
        $sId = mysqli_real_escape_string($this->dbConnectionEditor, $idIn);

        //remove all Russell Crowe Associations first
        //select all articles with page_id = idIn
        $deleteSql = "DELETE from page WHERE page_id='$sId'";

        $this->result =@$this->dbConnectionEditor->query($deleteSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionEditor->error);
        }
        return $this->dbConnectionEditor->affected_rows;

    }

/////////////////////////////////////////////////////////////
//-------------------ARTICLE SQL----------------------------
/////////////////////////////////////////////////////////////

    public function getArticles()
    {

        if($_SESSION['permission']=="admin")
        {
            $this->result =@$this->dbConnectionAdmin->query("SELECT * FROM article");
        }
        if($_SESSION['permission']=="editor")
        {
            $this->result =@$this->dbConnectionEditor->query("SELECT * FROM article");
        }
        if($_SESSION['permission']=="author")
        {
            $this->result =@$this->dbConnectionAuthor->query("SELECT * FROM article");
        }
        if(!isset($_SESSION['permission']))
        {
            $this->result =@$this->dbConnection->query("SELECT * FROM article");
        }
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' );
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

    public function insertArticle($nameIn, $titleIn, $descIn, $pageIn, $allIn, $divIn, $contentIn, $creatorIn)
    {

        if($_SESSION['permission']=="editor")
        {
        $snameIn= mysqli_real_escape_string($this->dbConnectionEditor, $nameIn);
        $stitleIn= mysqli_real_escape_string($this->dbConnectionEditor, $titleIn);
        $sdescIn= mysqli_real_escape_string($this->dbConnectionEditor, $descIn);
        $spageIn= mysqli_real_escape_string($this->dbConnectionEditor, $pageIn);
        $sallIn= mysqli_real_escape_string($this->dbConnectionEditor, $allIn);
        $sdivIn= mysqli_real_escape_string($this->dbConnectionEditor, $divIn);
        $scontentIn= mysqli_real_escape_string($this->dbConnectionEditor, $contentIn);
        $screatorIn= mysqli_real_escape_string($this->dbConnectionEditor, $creatorIn);
        }
        if($_SESSION['permission']=="author")
        {
        $snameIn= mysqli_real_escape_string($this->dbConnectionAuthor, $nameIn);
        $stitleIn= mysqli_real_escape_string($this->dbConnectionAuthor, $titleIn);
        $sdescIn= mysqli_real_escape_string($this->dbConnectionAuthor, $descIn);
        $spageIn= mysqli_real_escape_string($this->dbConnectionAuthor, $pageIn);
        $sallIn= mysqli_real_escape_string($this->dbConnectionAuthor, $allIn);
        $sdivIn= mysqli_real_escape_string($this->dbConnectionAuthor, $divIn);
        $scontentIn= mysqli_real_escape_string($this->dbConnectionAuthor, $contentIn);
        $screatorIn= mysqli_real_escape_string($this->dbConnectionAuthor, $creatorIn);
        }
        $sqlInsert = "INSERT INTO article (name, title, description,";
        if($allIn == 0)
            $sqlInsert .= "page_id, ";
        $sqlInsert .= "all_pages, content_area_id, the_content, created_date, created_by_id) VALUES('";
        $sqlInsert .=$snameIn ."', '";
        $sqlInsert .= $stitleIn . "', '";
        $sqlInsert .= $sdescIn . "', '";
        if($allIn == 0)
            $sqlInsert .= $spageIn . "', '";
        $sqlInsert .= $sallIn . "' , '";
        $sqlInsert .= $sdivIn . "', '" ;
        $sqlInsert .= $scontentIn .  "', ";
        $sqlInsert .= "NOW()" . ",'";
        $sqlInsert .= $screatorIn . "')";

        if($_SESSION['permission']=="editor")
        {
            $this->result =@$this->dbConnectionEditor->query($sqlInsert);
            if(!$this->result)
            {
                die('Could not retrieve pages from the Database: ');
            }
            return $this->dbConnectionEditor->affected_rows;
        }
        if($_SESSION['permission']=="author")
        {
            $this->result =@$this->dbConnectionAuthor->query($sqlInsert);
            if(!$this->result)
            {
                die('Could not retrieve pages from the Database: ');
            }
            return $this->dbConnectionAuthor->affected_rows;
        }
    }

    public function updateArticle($idIn, $nameIn, $titleIn, $descIn, $pageIn, $allIn, $divIn, $contentIn,$modID)
    {
        if($_SESSION['permission']=="editor")
        {
            $sidIn= mysqli_real_escape_string($this->dbConnectionEditor, $idIn);
            $snameIn= mysqli_real_escape_string($this->dbConnectionEditor, $nameIn);
            $stitleIn= mysqli_real_escape_string($this->dbConnectionEditor, $titleIn);
            $sdescIn= mysqli_real_escape_string($this->dbConnectionEditor, $descIn);
            $spageIn= mysqli_real_escape_string($this->dbConnectionEditor, $pageIn);
            $sallIn= mysqli_real_escape_string($this->dbConnectionEditor, $allIn);
            $sdivIn= mysqli_real_escape_string($this->dbConnectionEditor, $divIn);
            $scontentIn= mysqli_real_escape_string($this->dbConnectionEditor, $contentIn);
            $smodID= mysqli_real_escape_string($this->dbConnectionEditor, $modID);
        }
        if($_SESSION['permission']=="author")
        {
            $sidIn= mysqli_real_escape_string($this->dbConnectionAuthor, $idIn);
            $snameIn= mysqli_real_escape_string($this->dbConnectionAuthor, $nameIn);
            $stitleIn= mysqli_real_escape_string($this->dbConnectionAuthor, $titleIn);
            $sdescIn= mysqli_real_escape_string($this->dbConnectionAuthor, $descIn);
            $spageIn= mysqli_real_escape_string($this->dbConnectionAuthor, $pageIn);
            $sallIn= mysqli_real_escape_string($this->dbConnectionAuthor, $allIn);
            $sdivIn= mysqli_real_escape_string($this->dbConnectionAuthor, $divIn);
            $scontentIn= mysqli_real_escape_string($this->dbConnectionAuthor, $contentIn);
            $smodID= mysqli_real_escape_string($this->dbConnectionAuthor, $modID);
        }

        $updateSql = "UPDATE article SET ";
        $updateSql .= "name='" . $snameIn . "',";
        $updateSql .= "title='" . $stitleIn . "',";
        $updateSql .= "description='" . $sdescIn . "',";

        if($sallIn == 0)
            $updateSql .= "page_id='" . $spageIn . "',";

        $updateSql .= "all_pages='" . $sallIn . "',";
        $updateSql .= "content_area_id='" . $sdivIn . "',";
        $updateSql .= "the_content='" . $scontentIn . "',";
        $updateSql .= "modified_by_id='" . $smodID . "',";
        $updateSql .= "modified_date=NOW()";
        $updateSql .= "WHERE article_id=" . $sidIn;

        if($_SESSION['permission']=="editor")
        {
            $this->result =@$this->dbConnectionEditor->query($updateSql);
            if(!$this->result)
            {
                die('Could not retrieve pages from the Database: ');
            }
            return $this->dbConnectionEditor->affected_rows;
        }
        if($_SESSION['permission']=="author")
        {
            $this->result =@$this->dbConnectionAuthor->query($updateSql);
            if(!$this->result)
            {
                die('Could not retrieve pages from the Database: ');
            }
            return $this->dbConnectionAuthor->affected_rows;
        }
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ');
        }
        return $this->dbConnection->affected_rows;
    }

    public function deleteArticle($idIn)
    {
        $sidIn= mysqli_real_escape_string($this->dbConnectionEditor, $idIn);

        $deleteSql = "DELETE from article WHERE article_id='$sidIn'";

        $this->result =@$this->dbConnectionEditor->query($deleteSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionEditor->error);
        }
        return $this->dbConnectionEditor->affected_rows;

    }

    public function getAreaArticles($pageIdIn, $contentIDin)
    {
        if($_SESSION['permission']=="admin")
        {
            $spageIdIn= mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($pageIdIn));
            $scontentIDin= mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($contentIDin));
            $this->result =@$this->dbConnectionAdmin->query("SELECT * FROM article WHERE (page_id='$spageIdIn' or all_pages=1) and content_area_id='$scontentIDin'");
        }
        if($_SESSION['permission']=="editor")
        {
            $spageIdIn= mysqli_real_escape_string($this->dbConnectionEditor, stripslashes($pageIdIn));
            $scontentIDin= mysqli_real_escape_string($this->dbConnectionEditor, stripslashes($contentIDin));
            $this->result =@$this->dbConnectionEditor->query("SELECT * FROM article WHERE (page_id='$spageIdIn' or all_pages=1) and content_area_id='$scontentIDin'");
        }
        if($_SESSION['permission']=="author")
        {
            $spageIdIn= mysqli_real_escape_string($this->dbConnectionAuthor, stripslashes($pageIdIn));
            $scontentIDin= mysqli_real_escape_string($this->dbConnectionAuthor, stripslashes($contentIDin));
            $this->result =@$this->dbConnectionAuthor->query("SELECT * FROM article WHERE (page_id='$spageIdIn' or all_pages=1) and content_area_id='$scontentIDin'");
        }
        if(!isset($_SESSION['permission']))
        {
            $spageIdIn= mysqli_real_escape_string($this->dbConnection, stripslashes($pageIdIn));
            $scontentIDin= mysqli_real_escape_string($this->dbConnection, stripslashes($contentIDin));
            $this->result =@$this->dbConnection->query("SELECT * FROM article WHERE (page_id='$spageIdIn' or all_pages=1) and content_area_id='$scontentIDin'");
        }
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }

    public function getSingleArticle($articleIdIn)
    {
        if($_SESSION['permission']=="admin")
        {
            $sarticleIdIn= mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($articleIdIn));
            $this->result =@$this->dbConnectionAdmin->query("SELECT * FROM article WHERE article_id='$sarticleIdIn'");
        }
        if($_SESSION['permission']=="editor")
        {
            $sarticleIdIn= mysqli_real_escape_string($this->dbConnectionEditor, stripslashes($articleIdIn));
            $this->result =@$this->dbConnectionEditor->query("SELECT * FROM article WHERE article_id='$sarticleIdIn'");
        }
        if($_SESSION['permission']=="author")
        {
            $sarticleIdIn= mysqli_real_escape_string($this->dbConnectionAuthor, stripslashes($articleIdIn));
            $this->result =@$this->dbConnectionAuthor->query("SELECT * FROM article WHERE article_id='$sarticleIdIn'");
        }
        if(!isset($_SESSION['permission']))
        {
            $sarticleIdIn= mysqli_real_escape_string($this->dbConnection, stripslashes($articleIdIn));
            $this->result =@$this->dbConnection->query("SELECT * FROM article WHERE article_id='$sarticleIdIn'");
        }
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }

/////////////////////////////////////////////////////////////
//-------------------CONTENT SQL----------------------------
/////////////////////////////////////////////////////////////

    public function getContentArea()
    {
        if($_SESSION['permission']=="admin")
        {
            $this->result =@$this->dbConnectionAdmin->query("SELECT * FROM content_area");
        }
        if($_SESSION['permission']=="editor")
        {
            $this->result =@$this->dbConnectionEditor->query("SELECT * FROM content_area");
        }
        if($_SESSION['permission']=="author")
        {
            $this->result =@$this->dbConnectionAuthor->query("SELECT * FROM content_area");
        }
        if(!isset($_SESSION['permission']))
        {
            $this->result =@$this->dbConnection->query("SELECT * FROM content_area");
        }
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ');
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

    public function insertDiv($nameIn, $divNameIn, $orderIn, $descIn, $creatorIn)
    {
        $snameIn= mysqli_real_escape_string($this->dbConnectionEditor, $nameIn);
        $sdivNameIn= mysqli_real_escape_string($this->dbConnectionEditor, $divNameIn);
        $sorderIn= mysqli_real_escape_string($this->dbConnectionEditor, $orderIn);
        $sdescIn= mysqli_real_escape_string($this->dbConnectionEditor, $descIn);
        $screatorIn= mysqli_real_escape_string($this->dbConnectionEditor, $creatorIn);

        $sqlInsert = "INSERT INTO content_area (name, div_name, page_order_pos, description, created_date, created_by_id)
        VALUES('$snameIn', '$sdivNameIn', '$sorderIn', '$sdescIn', NOW(), '$screatorIn')";

        $this->result =@$this->dbConnectionEditor->query($sqlInsert);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionEditor->error);
        }
        return $this->dbConnectionEditor->affected_rows;
    }

    public function updateDiv($idIn, $nameIn, $divNameIn, $descIn, $orderIn,$modIn)
    {
        $sidIn= mysqli_real_escape_string($this->dbConnectionEditor, $idIn);
        $snameIn= mysqli_real_escape_string($this->dbConnectionEditor, $nameIn);
        $sdivNameIn= mysqli_real_escape_string($this->dbConnectionEditor, $divNameIn);
        $sorderIn= mysqli_real_escape_string($this->dbConnectionEditor, $orderIn);
        $sdescIn= mysqli_real_escape_string($this->dbConnectionEditor, $descIn);
        $smodIn= mysqli_real_escape_string($this->dbConnectionEditor, $modIn);

        $updateSql = "UPDATE content_area SET ";
        $updateSql .= "name='" . $snameIn . "',";
        $updateSql .= "div_name='" . $sdivNameIn . "',";
        $updateSql .= "description='" . $sdescIn . "',";
        $updateSql .= "page_order_pos='" . $sorderIn;
        $updateSql .= "modified_by_id='" . $smodIn ."',";
        $updateSql .= "modified_date=NOW()";
        $updateSql .= "' WHERE content_id=" . $sidIn;

        $this->result =@$this->dbConnectionEditor->query($updateSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionEditor->error);
        }
        return $this->dbConnectionEditor->affected_rows;
    }

    public function getSingleDiv($divIdIn)
    {
        if($_SESSION['permission']=="admin")
        {
            $sdivIdIn= mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($divIdIn));
            $this->result =@$this->dbConnectionAdmin->query("SELECT * FROM content_area WHERE content_id='$sdivIdIn'");
        }
        if($_SESSION['permission']=="editor")
        {
            $sdivIdIn= mysqli_real_escape_string($this->dbConnectionEditor, stripslashes($divIdIn));
            $this->result =@$this->dbConnectionEditor->query("SELECT * FROM content_area WHERE content_id='$sdivIdIn'");
        }
        if($_SESSION['permission']=="author")
        {
            $sdivIdIn= mysqli_real_escape_string($this->dbConnectionAuthor, stripslashes($divIdIn));
            $this->result =@$this->dbConnectionAuthor->query("SELECT * FROM content_area WHERE content_id='$sdivIdIn'");
        }
        if(!isset($_SESSION['permission']))
        {
            $sdivIdIn= mysqli_real_escape_string($this->dbConnection, stripslashes($divIdIn));
            $this->result =@$this->dbConnection->query("SELECT * FROM content_area WHERE content_id='$sdivIdIn'");
        }

        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }

    public function deleteDiv($idIn)
    {
        $sidIn= mysqli_real_escape_string($this->dbConnectionEditor, $idIn);

        $deleteSql = "DELETE from content_area WHERE content_id='$sidIn'";

        $this->result =@$this->dbConnectionEditor->query($deleteSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionEditor->error);
        }
        return $this->dbConnectionEditor->affected_rows;
    }

/////////////////////////////////////////////////////////////
//-------------------CSS SQL----------------------------
/////////////////////////////////////////////////////////////

    public function getCss()
    {
        if($_SESSION['permission']=="admin")
        {
            $this->result =@$this->dbConnectionAdmin->query("SELECT * FROM css");
        }
        if($_SESSION['permission']=="editor")
        {
            $this->result =@$this->dbConnectionEditor->query("SELECT * FROM css");
        }
        if($_SESSION['permission']=="author")
        {
            $this->result =@$this->dbConnectionAuthor->query("SELECT * FROM css");
        }
        if(!isset($_SESSION['permission']))
        {
            $this->result =@$this->dbConnection->query("SELECT * FROM css");
        }
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ');
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

    public function insertCss($nameIn,$descIn, $activeIn, $contentIn, $creatorIn)
    {
        $snameIn= mysqli_real_escape_string($this->dbConnectionEditor, $nameIn);
        $sdescIn= mysqli_real_escape_string($this->dbConnectionEditor, $descIn);
        $sactiveIn= mysqli_real_escape_string($this->dbConnectionEditor, $activeIn);
        $scontentIn= mysqli_real_escape_string($this->dbConnectionEditor, $contentIn);
        $screatorIn= mysqli_real_escape_string($this->dbConnectionEditor, $creatorIn);

        $sqlInsert =    "INSERT INTO css (name, description, active_status, style_snippet,created_date, created_by_id)
                        VALUES('$snameIn', '$sdescIn', '$sactiveIn', '$scontentIn',NOW(), '$screatorIn' )";

        $this->result =@$this->dbConnectionEditor->query($sqlInsert);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionEditor->error);
        }
        return $this->dbConnectionEditor->affected_rows;
    }

    public function updateCss($idIn, $nameIn, $descIn, $activeIn, $contentIn,$modIn)
    {
        $sidIn= mysqli_real_escape_string($this->dbConnectionEditor, $idIn);
        $snameIn= mysqli_real_escape_string($this->dbConnectionEditor, $nameIn);
        $sdescIn= mysqli_real_escape_string($this->dbConnectionEditor, $descIn);
        $sactiveIn= mysqli_real_escape_string($this->dbConnectionEditor, $activeIn);
        $scontentIn= mysqli_real_escape_string($this->dbConnectionEditor, $contentIn);
        $smodIn= mysqli_real_escape_string($this->dbConnectionEditor, $modIn);

        $updateSql = "UPDATE css SET ";
        $updateSql .= "name='" . $nameIn . "',";
        $updateSql .= "description='" . $descIn . "',";
        $updateSql .= "active_status='" . $activeIn . "',";
        $updateSql .= "style_snippet='" . $contentIn;
        $updateSql .= "modified_by_id='" . $modIn . "',";
        $updateSql .= "modified_date=NOW()";
        $updateSql .= "' WHERE css_id=" . $idIn;

        $this->result =@$this->dbConnectionEditor->query($updateSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionEditor->error);
        }
        return $this->dbConnectionEditor->affected_rows;
    }

    public function getSingleCss($cssIdIn)
    {
        if($_SESSION['permission']=="admin")
        {
            $scssIdIn= mysqli_real_escape_string($this->dbConnectionAdmin, $cssIdIn);
            $this->result =@$this->dbConnectionAdmin->query("SELECT * FROM css WHERE css_id='$scssIdIn'");
        }
        if($_SESSION['permission']=="editor")
        {
            $scssIdIn= mysqli_real_escape_string($this->dbConnectionEditor, ($cssIdIn));
            $this->result =@$this->dbConnectionEditor->query("SELECT * FROM css WHERE css_id='$scssIdIn'");
        }
        if($_SESSION['permission']=="author")
        {
            $scssIdIn= mysqli_real_escape_string($this->dbConnectionAuthor, ($cssIdIn));
            $this->result =@$this->dbConnectionAuthor->query("SELECT * FROM css WHERE css_id='$scssIdIn'");
        }
        if(!isset($_SESSION['permission']))
        {
            $scssIdIn= mysqli_real_escape_string($this->dbConnection, ($cssIdIn));
            $this->result =@$this->dbConnection->query("SELECT * FROM css WHERE css_id='$scssIdIn'");
        }

        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnection->error);
        }
    }

    public function deleteCss($idIn)
    {
        $sidIn= mysqli_real_escape_string($this->dbConnectionEditor, $idIn);

        $deleteSql = "DELETE from css WHERE css_id='$sidIn'";

        $this->result =@$this->dbConnectionEditor->query($deleteSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionEditor->error);
        }
        return $this->dbConnectionEditor->affected_rows;

    }

/////////////////////////////////////////////////////////////
//-------------------USER SQL----------------------------
/////////////////////////////////////////////////////////////

    public function getUsers()
    {
        $this->result =@$this->dbConnectionAdmin->query("SELECT * FROM user");
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionAdmin->error);
        }

    }//end getPages

    public function fetchUsers()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnectionAdmin->error);
        }
        return $this->result->fetch_array();
    }

    public function getSingleUser($userID_in)
    {
        $number = mysqli_real_escape_string($this->dbConnectionAdmin, $userID_in);
        $this->result =@$this->dbConnectionAdmin->query("SELECT * FROM user WHERE user_id='$number'");

        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionAdmin->error);
        }
    }

    public function updateUser($idIn, $usernameIn, $FnameIn, $LnameIn, $wordPassIn,$permissionIn, $modID, $saltIn) //$modID) // This needs to be added when logins are better setup
    {
        $sidIn = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($idIn));
        $susernameIn = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($usernameIn));
        $sFnameIn = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($FnameIn));
        $sLnameIn = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($LnameIn));
        $swordPassIn = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($wordPassIn));
        $spermissionIn = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($permissionIn));
        $smodID = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($modID));
        $ssaltIn = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($saltIn));

        $updateSql = "UPDATE user SET ";
        $updateSql .= "username='" .$susernameIn  . "',";
        $updateSql .= "first_name='" . $sFnameIn . "',";
        $updateSql .= "last_name='" . $sLnameIn . "',";
        $updateSql .= "password='" . $swordPassIn. "',";
        $updateSql .= "permissions_id='" . $spermissionIn. "',";
        $updateSql .= "modified_by_id='" . $smodID. "',";
        $updateSql .= "password_salt='" . $ssaltIn. "',";
        $updateSql .= "last_modified_date=NOW()";
        $updateSql .= "WHERE user_id=" . $sidIn;

        $this->result =@$this->dbConnectionAdmin->query($updateSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionAdmin->error);
        }
        return $this->dbConnectionAdmin->affected_rows;
    }

    public function updateUserPriv($idIn,$permissionIn,$modID) // This needs to be added when logins are better setup
    {
        $sidIn = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($idIn));
        $spermissionIn = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($permissionIn));
        $smodID = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($modID));

        $updateSql = "UPDATE user SET ";
        $updateSql .= "permissions_id='" . $spermissionIn. "',";
        $updateSql .= "modified_by_id='" . $smodID. "',";
        $updateSql .= "last_modified_date=NOW()";
        $updateSql .= "WHERE user_id=" . $sidIn;

        $this->result =@$this->dbConnectionAdmin->query($updateSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionAdmin->error);
        }
        return $this->dbConnectionAdmin->affected_rows;
    }

    public function insertUser($usernameIn,$userFnameIn,$userLnameIn,$userPassword,$creatorIn,$saltIn) //Creator ID still needs to be added!
    {
        $this->result =@$this->dbConnectionAdmin->query("SELECT user_id FROM user");
        $rowcount=(mysqli_num_rows($this->result)+1);

        $sUsername = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($usernameIn));
        $sUserFname = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($userFnameIn));
        $sUseLrname = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($userLnameIn));
        $sUserPass = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($userPassword));
        $sUserCreator = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($creatorIn));
        $sUserSalt = mysqli_real_escape_string($this->dbConnectionAdmin, stripslashes($saltIn));

        $sql = "INSERT INTO user (user_id,username,first_name,last_name,password,created_date,created_by_id,password_salt)
                VALUES ('$rowcount','$sUsername','$sUserFname','$sUseLrname','$sUserPass', NOW(),'$sUserCreator','$sUserSalt' )";
        if(!mysqli_query($this->dbConnectionAdmin, $sql))
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionAdmin->error);
        }
        return $this->dbConnectionAdmin->affected_rows;
    }

    public function deleteUser($idIn)
    {
        $deleteSql = "DELETE from user WHERE user_id='$idIn'";

        $this->result =@$this->dbConnectionAdmin->query($deleteSql);
        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ' .
                $this->dbConnectionAdmin->error);
        }
        return $this->dbConnectionAdmin->affected_rows;

    }

    public function checkUserLogin($userIn)
    {
        $sql = "SELECT * FROM user WHERE username='";
        $sql.= $userIn . "'";
        if($_SESSION['permission']=="admin")
        {$this->result =@$this->dbConnectionAdmin->query($sql);}
        if($_SESSION['permission']=="editor")
        {$this->result =@$this->dbConnectionEditor->query($sql);}
        if(!isset($_SESSION['permission']))
        { $this->result =@$this->dbConnection->query($sql);}

        if(!$this->result)
        {
            die('Could not retrieve pages from the Database: ');
        }
    }

/////////////////////////////////////////////////////////////
//-------------------FETCH SQL----------------------------
/////////////////////////////////////////////////////////////

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
    public function fetchUSalt($row)
    {
        return $row['password_salt'];
    }
    ///////////////////////////////////////////////////////////////


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
}//end class DataAccessMySQLi
