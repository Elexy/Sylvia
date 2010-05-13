<?php

/**
 * Employees form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseEmployeesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'employeeid'   => new sfWidgetFormInputHidden(),
      'firstname'    => new sfWidgetFormInput(),
      'middlename'   => new sfWidgetFormInput(),
      'lastname'     => new sfWidgetFormInput(),
      'title'        => new sfWidgetFormInput(),
      'extension'    => new sfWidgetFormInput(),
      'workphone'    => new sfWidgetFormInput(),
      'homephone'    => new sfWidgetFormInput(),
      'mobilephone'  => new sfWidgetFormInput(),
      'login'        => new sfWidgetFormInput(),
      'pwd'          => new sfWidgetFormInput(),
      'uid'          => new sfWidgetFormInput(),
      'groupid'      => new sfWidgetFormInput(),
      'address'      => new sfWidgetFormInput(),
      'postcode'     => new sfWidgetFormInput(),
      'city'         => new sfWidgetFormInput(),
      'birth_date'   => new sfWidgetFormDate(),
      'gender'       => new sfWidgetFormInput(),
      'passport'     => new sfWidgetFormInput(),
      'sofinumber'   => new sfWidgetFormInput(),
      'salary_month' => new sfWidgetFormInput(),
      'start'        => new sfWidgetFormDate(),
      'end'          => new sfWidgetFormDate(),
      'bankrekening' => new sfWidgetFormInput(),
      'girorekening' => new sfWidgetFormInput(),
      'afstand_km'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'employeeid'   => new sfValidatorPropelChoice(array('model' => 'Employees', 'column' => 'employeeid', 'required' => false)),
      'firstname'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'middlename'   => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'lastname'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'extension'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'workphone'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'homephone'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'mobilephone'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'login'        => new sfValidatorString(array('max_length' => 25)),
      'pwd'          => new sfValidatorString(array('max_length' => 25)),
      'uid'          => new sfValidatorString(array('max_length' => 25)),
      'groupid'      => new sfValidatorInteger(),
      'address'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'postcode'     => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'city'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'birth_date'   => new sfValidatorDate(array('required' => false)),
      'gender'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'passport'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'sofinumber'   => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'salary_month' => new sfValidatorNumber(array('required' => false)),
      'start'        => new sfValidatorDate(array('required' => false)),
      'end'          => new sfValidatorDate(array('required' => false)),
      'bankrekening' => new sfValidatorInteger(),
      'girorekening' => new sfValidatorInteger(),
      'afstand_km'   => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('employees[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Employees';
  }


}
