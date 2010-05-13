<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class wsGenuser
{
  	/**
	 * The value for the id field.
	 * @var        double
	 */
	public $id;

	/**
	 * The value for the uid field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	public $uid;

	/**
	 * The value for the pwd field.
	 * @var        string
	 */
	public $pwd;

	/**
	 * The value for the raccess_s field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $raccess_s;

	/**
	 * The value for the raccess_a field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $raccess_a;

	/**
	 * The value for the raccess_v field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $raccess_v;

	/**
	 * The value for the raccess_r field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $raccess_r;

	/**
	 * The value for the waccess_s field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $waccess_s;

	/**
	 * The value for the waccess_a field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $waccess_a;

	/**
	 * The value for the waccess_v field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $waccess_v;

	/**
	 * The value for the waccess_r field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $waccess_r;

	/**
	 * The value for the saccess_s field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $saccess_s;

	/**
	 * The value for the saccess_a field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $saccess_a;

	/**
	 * The value for the saccess_v field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $saccess_v;

	/**
	 * The value for the saccess_r field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $saccess_r;

	/**
	 * The value for the supervisor field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $supervisor;

	/**
	 * The value for the email field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	public $email;

	/**
	 * The value for the logon_attempts field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $logon_attempts;

	/**
	 * The value for the active field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $active;

	/**
	 * The value for the stylesheetid field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	public $stylesheetid;

	/**
	 * The value for the deflanguage field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	public $deflanguage;

	/**
	 * The value for the contactid field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	public $contactid;

	/**
	 * The value for the employee_id field.
	 * @var        int
	 */
	public $employee_id;

  public function __construct($realPart, $imaginaryPart)
  {
    $this->id = $id;
    $this->uid = $uid;
    $this->pwd = $pwd;
    $this->raccess_s = $raccess_s;
    $this->raccess_a = $raccess_a;
    $this->raccess_v = $raccess_a;
    $this->raccess_r = $raccess_a;
    $this->waccess_s = $raccess_a;
    $this->waccess_a = $waccess_a;
    $this->waccess_v = $waccess_a;
    $this->waccess_r = $waccess_a;
    $this->saccess_s = $saccess_s;
    $this->saccess_a = $saccess_s;
    $this->saccess_v = $saccess_v;
    $this->saccess_r = $saccess_r;
    $this->supervisor = $saccess_r;
    $this->email = $saccess_r;
    $this->active = $active;
    $this->stylesheetid = $saccess_r;
    $this->deflanguage = $deflanguage;
    $this->contactid = $contactid;
    $this->employee_id = $contactid;
  }

  public function __toString()
  {
    return $this->uid;
  }

  public function getAll()
  {
    $genUsers = GenuserPeer::doSelect(new Criteria);
    $result = array();
    foreach($genUsers as $genUser) {
      $temp = new wsGenuser;
      $temp->id = $genUser->getId();
      $temp->uid = $genUser->getUid();
      $temp->pwd = $genUser->getPwd();
      $temp->raccess_s = $genUser->getRaccess_s();
      $temp->raccess_a = $genUser->getRaccess_a();
      $temp->raccess_v = $genUser->getRaccess_a();
      $temp->raccess_r = $genUser->getRaccess_a();
      $temp->waccess_s = $genUser->getRaccess_a();
      $temp->waccess_a = $genUser->getWaccess_a();
      $temp->waccess_v = $genUser->getWaccess_a();
      $temp->waccess_r = $genUser->getWaccess_a();
      $temp->saccess_s = $genUser->getSaccess_s();
      $temp->saccess_a = $genUser->getSaccess_s();
      $temp->saccess_v = $genUser->getSaccess_v();
      $temp->saccess_r = $genUser->getSaccess_r();
      $temp->supervisor = $genUser->getSupervisor();
      $temp->email = $genUser->getEmail();
      $temp->active = $genUser->getActive();
      $temp->stylesheetid = $genUser->getStylesheetid();
      $temp->deflanguage = $genUser->getDeflanguage();
      $temp->contactid = $genUser->getContactid();
      $temp->employee_id = $genUser->getContactid();
      $result[] = $temp;
    }
    return $result;
  }
}
?>
