<?php
require_once '../Database/dbConn.php';
class UserClass
{
    //PROPERTIES
    private $userID;
    private $username;
    private $userFirstName;
    private $userLastName;
    private $wordPass;
    private $wordPassSalt;
    private $creator;
    private $modBy;
    private $createDate;
    private $modDate;
    private $permisions;
    //CONSTRuCTOR
    public function __construct($username_in)
    {
        $this->username = $username_in;
    }
    public static function retrieveUsers()
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();
        $myDataAccess->getUsers();
        while($row = $myDataAccess->fetchUsers())
        {
            $currentUser = new self($myDataAccess->fetchUUserName($row));
            $currentUser->userID = $myDataAccess->fetchUUserID($row);
            $currentUser->userFirstName =$myDataAccess->fetchUUserFName($row);
            $currentUser->userLastName = $myDataAccess->fetchUUserLName($row);
            $currentUser->wordPass = $myDataAccess->fetchUWordPass($row);
            $currentUser->creator = $myDataAccess->fetchUCreator($row);
            $currentUser->createDate = $myDataAccess->fetchUCreateDate($row);
            $currentUser->modBy = $myDataAccess->fetchUModified($row);
            $currentUser->modDate = $myDataAccess->fetchUModDate($row);
            $arrayOfUsers[] = $currentUser;
        }
        $myDataAccess->closeDBConn();
        return $arrayOfUsers;
    }
    public function getSingleUser($userIdIn)
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();
        $myDataAccess->getSingleUser($userIdIn);
        $row = $myDataAccess->fetchUsers();
        $currentUser = new self($myDataAccess->fetchUUserName($row));
        $currentUser->userID = $myDataAccess->fetchUUserID($row);
        $currentUser->userFirstName =$myDataAccess->fetchUUserFName($row);
        $currentUser->userLastName = $myDataAccess->fetchUUserLName($row);
        $currentUser->wordPass = $myDataAccess->fetchUWordPass($row);
        $currentUser->creator = $myDataAccess->fetchUCreator($row);
        $currentUser->createDate = $myDataAccess->fetchUCreateDate($row);
        $currentUser->modBy = $myDataAccess->fetchUModified($row);
        $currentUser->modDate = $myDataAccess->fetchUModDate($row);
        $myDataAccess->closeDBConn();
        return $currentUser;
    }
    public function addUser($username,$userFnameIn,$userLnameIn,$userPassword,$userCreatorID)
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();
        $myDataAccess->addUser($username,$userFnameIn,$userLnameIn,$userPassword,$userCreatorID);
    }
    public function updateUser()
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();
        $rowsAffected = $myDataAccess->updateUser($this->userID
            ,$this->username
            ,$this->userFirstName
            ,$this->userLastName
            ,$this->wordPass);
        $myDataAccess->closeDBConn();
        return $rowsAffected . " row(s) Affected.";
    }
    public function saveUser()
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();
        $rowsAffected = $myDataAccess->insertUser(
            $this->username
            ,$this->userFirstName
            ,$this->userLastName
            ,$this->wordPass);
        $myDataAccess->closeDBConn();
        return $rowsAffected . " row(s) Affected.";
    }
    public function deleteUser()
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();
        $rowsAffected = $myDataAccess->deleteUser($this->userID);
        return $rowsAffected . " row(s) affected";
    }

    public function checkLoginInfo($userIn, $pwIn)
    {
        $myDataAccess = DataAccessMySQLi::getInstance();
        $myDataAccess->getDBConn();
        $myDataAccess->checkUserLogin($userIn, $pwIn);

        $row = $myDataAccess->fetchUsers();

        $currentUser = new self($myDataAccess->fetchUUserName($row));
        $currentUser->userID = $myDataAccess->fetchUUserID($row);
        $currentUser->userFirstName =$myDataAccess->fetchUUserFName($row);
        $currentUser->userLastName = $myDataAccess->fetchUUserLName($row);
        $currentUser->wordPass = $myDataAccess->fetchUWordPass($row);
        $currentUser->creator = $myDataAccess->fetchUCreator($row);
        $currentUser->createDate = $myDataAccess->fetchUCreateDate($row);
        $currentUser->modBy = $myDataAccess->fetchUModified($row);
        $currentUser->modDate = $myDataAccess->fetchUModDate($row);
        $myDataAccess->closeDBConn();

        return $currentUser;
    }
    // GETTERS
    public function getId()
    {
        return $this->userID;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getFistName()
    {
        return $this->userFirstName;
    }
    public function getLastName()
    {
        return $this->userLastName;
    }
    public function getWordPass()
    {
        return $this->wordPass;
    }
    public function getCreatedBy()
    {
        return $this->creator;
    }
    public function getCreatedDate()
    {
        return $this->createDate;
    }
    public function getModifier()
    {
        return $this->modBy;
    }
    public function getModDate()
    {
        return $this->modDate;
    }
// SETTERS
    public function setId($id_in)
    {
        $this->userID =$id_in;
    }
    public function setUsername($username_in)
    {
        $this->username = $username_in;
    }
    public function setFistName($fname_in)
    {
        $this->userFirstName = $fname_in;
    }
    public function setLastName($lname_in)
    {
        $this->userLastName = $lname_in;
    }
    public function setWordPass($wordpas_in)
    {
        $this->wordPass = $wordpas_in;
    }
    public function setCreatedBy($creator_in)
    {
        $this->creator = $creator_in;
    }
    public function setCreatedDate($creatDate_in)
    {
        $this->createDate = $creatDate_in;
    }
    public function setModifier($modif_in)
    {
        $this->modBy = $modif_in;
    }
    public function setModDate($moddate_in)
    {
        $this->modDate = $moddate_in;
    }
}//end UserClass