<?php

/**
 * Employees filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseEmployeesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dummy'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'login'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pwd'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'uid'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'groupid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bankrekening' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'girorekening' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'firstname'    => new sfWidgetFormFilterInput(),
      'middlename'   => new sfWidgetFormFilterInput(),
      'lastname'     => new sfWidgetFormFilterInput(),
      'title'        => new sfWidgetFormFilterInput(),
      'extension'    => new sfWidgetFormFilterInput(),
      'workphone'    => new sfWidgetFormFilterInput(),
      'homephone'    => new sfWidgetFormFilterInput(),
      'mobilephone'  => new sfWidgetFormFilterInput(),
      'address'      => new sfWidgetFormFilterInput(),
      'postcode'     => new sfWidgetFormFilterInput(),
      'city'         => new sfWidgetFormFilterInput(),
      'birth_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'gender'       => new sfWidgetFormFilterInput(),
      'passport'     => new sfWidgetFormFilterInput(),
      'sofinumber'   => new sfWidgetFormFilterInput(),
      'salary_month' => new sfWidgetFormFilterInput(),
      'start'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'end'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'afstand_km'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'dummy'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'login'        => new sfValidatorPass(array('required' => false)),
      'pwd'          => new sfValidatorPass(array('required' => false)),
      'uid'          => new sfValidatorPass(array('required' => false)),
      'groupid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'bankrekening' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'girorekening' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'firstname'    => new sfValidatorPass(array('required' => false)),
      'middlename'   => new sfValidatorPass(array('required' => false)),
      'lastname'     => new sfValidatorPass(array('required' => false)),
      'title'        => new sfValidatorPass(array('required' => false)),
      'extension'    => new sfValidatorPass(array('required' => false)),
      'workphone'    => new sfValidatorPass(array('required' => false)),
      'homephone'    => new sfValidatorPass(array('required' => false)),
      'mobilephone'  => new sfValidatorPass(array('required' => false)),
      'address'      => new sfValidatorPass(array('required' => false)),
      'postcode'     => new sfValidatorPass(array('required' => false)),
      'city'         => new sfValidatorPass(array('required' => false)),
      'birth_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'gender'       => new sfValidatorPass(array('required' => false)),
      'passport'     => new sfValidatorPass(array('required' => false)),
      'sofinumber'   => new sfValidatorPass(array('required' => false)),
      'salary_month' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'start'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'end'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'afstand_km'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('employees_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Employees';
  }

  public function getFields()
  {
    return array(
      'employeeid'   => 'Number',
      'dummy'        => 'Date',
      'login'        => 'Text',
      'pwd'          => 'Text',
      'uid'          => 'Text',
      'groupid'      => 'Number',
      'bankrekening' => 'Number',
      'girorekening' => 'Number',
      'firstname'    => 'Text',
      'middlename'   => 'Text',
      'lastname'     => 'Text',
      'title'        => 'Text',
      'extension'    => 'Text',
      'workphone'    => 'Text',
      'homephone'    => 'Text',
      'mobilephone'  => 'Text',
      'address'      => 'Text',
      'postcode'     => 'Text',
      'city'         => 'Text',
      'birth_date'   => 'Date',
      'gender'       => 'Text',
      'passport'     => 'Text',
      'sofinumber'   => 'Text',
      'salary_month' => 'Number',
      'start'        => 'Date',
      'end'          => 'Date',
      'afstand_km'   => 'Number',
    );
  }
}
