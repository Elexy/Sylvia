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
      'firstname'    => new sfWidgetFormInputText(),
      'middlename'   => new sfWidgetFormInputText(),
      'lastname'     => new sfWidgetFormInputText(),
      'title'        => new sfWidgetFormInputText(),
      'extension'    => new sfWidgetFormInputText(),
      'workphone'    => new sfWidgetFormInputText(),
      'homephone'    => new sfWidgetFormInputText(),
      'mobilephone'  => new sfWidgetFormInputText(),
      'login'        => new sfWidgetFormInputText(),
      'pwd'          => new sfWidgetFormInputText(),
      'uid'          => new sfWidgetFormInputText(),
      'groupid'      => new sfWidgetFormInputText(),
      'address'      => new sfWidgetFormInputText(),
      'postcode'     => new sfWidgetFormInputText(),
      'city'         => new sfWidgetFormInputText(),
      'birth_date'   => new sfWidgetFormDate(),
      'gender'       => new sfWidgetFormInputText(),
      'passport'     => new sfWidgetFormInputText(),
      'sofinumber'   => new sfWidgetFormInputText(),
      'salary_month' => new sfWidgetFormInputText(),
      'start'        => new sfWidgetFormDate(),
      'end'          => new sfWidgetFormDate(),
      'bankrekening' => new sfWidgetFormInputText(),
      'girorekening' => new sfWidgetFormInputText(),
      'afstand_km'   => new sfWidgetFormInputText(),
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
