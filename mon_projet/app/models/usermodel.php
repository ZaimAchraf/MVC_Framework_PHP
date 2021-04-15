<?php 
namespace PHPMVC\Models;
/**
 * 
 */
class UserModel extends AbstractModel
{
	private $userID;
	private $fullName;
	private $userName;
	private $email;
    private $password;
    private $sex;
    private $birthDay;
    private $ville;
    private $tel;
    private $PostalCode;
    private $groupID;
    private $confirmed = 0;

	protected static $pk = 'userID';
	protected static $tableName = 'users';
	protected static $tableSchema = 
	array(

		'userID' => DATA_TYPE_STR,
		'fullName' => DATA_TYPE_STR,
		'userName' => DATA_TYPE_STR,
		'email' => DATA_TYPE_STR,
        'password' => DATA_TYPE_STR,
        'sex' => DATA_TYPE_INT,
        'birthDay' => DATA_TYPE_STR,
        'ville' => DATA_TYPE_STR,
        'tel' => DATA_TYPE_INT,
        'PostalCode' => DATA_TYPE_INT,
        'groupID' => DATA_TYPE_INT,
        'confirmed' => DATA_TYPE_INT

	);

	function __construct($id, $fullname, $username, $email, $password, $sex, $birthDay, $ville = '', $tel = -1, $postal = -1, $groupID = 0)
	{
		$this->userID     = $id;
		$this->fullName   = $fullname;
		$this->userName   = $username;
		$this->email      = $email;
        $this->password   = $password;
        $this->sex        = $sex;
        $this->birthDay   = $birthDay;
        $this->ville      = $ville;
        $this->tel        = $tel;
        $this->PostalCode = $postal;
        $this->groupID    = $groupID;


	}

	public function get_userID(){
	    return $this->userID;
    }

    public function get_fullName(){
        return $this->fullName;
    }

    public function get_userName(){
        return $this->userName;
    }

    public function get_email(){
        return $this->email;
    }

    public function get_password(){
        return $this->password;
    }

    public function get_sex(){
        return $this->sex;
    }

    public function get_birthDay(){
        return $this->birthDay;
    }

    public function get_ville(){
        return $this->ville;
    }

    public function get_tel(){
        return $this->tel;
    }

    public function get_PostalCode(){
        return $this->PostalCode;
    }

    public function get_groupID(){
        return $this->groupID;
    }

    public function get_confirmed(){
        return $this->confirmed;
    }


    public function add_adress($adress)
    {
        global $handler;
        $sql = 'INSERT INTO adresses VALUES ("' . $adress . '", "' . $this->userID . '")';

        $stmt = $handler->prepare($sql);
        return $stmt->execute(array());
    }
}
