<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Employees filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseEmployeesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'firstname'    => new sfWidgetFormFilterInput(),
      'middlename'   => new sfWidgetFormFilterInput(),
      'lastname'     => new sfWidgetFormFilterInput(),
      'title'        => new sfWidgetFormFilterInput(),
      'extension'    => new sfWidgetFormFilterInput(),
      'workphone'    => new sfWidgetFormFilterInput(),
      'homephone'    => new sfWidgetFormFilterInput(),
      'mobilephone'  => new sfWidgetFormFilterInput(),
      'login'        => new sfWidgetFormFilterInput(),
      'pwd'          => new sfWidgetFormFilterInput(),
      'uid'          => new sfWidgetFormFilterInput(),
      'groupid'      => new sfWidgetFormFilterInput(),
      'address'      => new sfWidgetFormFilterInput(),
      'postcode'     => new sfWidgetFormFilterInput(),
      'city'         => new sfWidgetFormFilterInput(),
      'birth_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'gender'       => new sfWidgetFormFilterInput(),
      'passport'     => new sfWidgetFormFilterInput(),
      'sofinumber'   => new sfWidgetFormFilterInput(),
      'salary_month' => new sfWidgetFormFilterInput(),
      'start'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'end'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'bankrekening' => new sfWidgetFormFilterInput(),
      'girorekening' => new sfWidgetFormFilterInput(),
      'afstand_km'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'firstname'    => new sfValidatorPass(array('required' => false)),
      'middlename'   => new sfValidatorPass(array('required' => false)),
      'lastname'     => new sfValidatorPass(array('required' => false)),
      'title'        => new sfValidatorPass(array('required' => false)),
      'extension'    => new sfValidatorPass(array('required' => false)),
      'workphone'    => new sfValidatorPass(array('required' => false)),
      'homephone'    => new sfValidatorPass(array('required' => false)),
      'mobilephone'  => new sfValidatorPass(array('required' => false)),
      'login'        => new sfValidatorPass(array('required' => false)),
      'pwd'          => new sfValidatorPass(array('required' => false)),
      'uid'          => new sfValidatorPass(array('required' => false)),
      'groupid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'address'      => new sfValidatorPass(array('required' => false)),
      'postcode'     => new sfValidatorPass(array('required' => false)),
      'city'         => new sfValidatorPass(array('required' => false)),
      'birth_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'gender'       => new sfValidatorPass(array('required' => false)),
      'passport'     => new sfValidatorPass(array('required' => false)),
      'sofinumber'   => new sfValidatorPass(array('required' => false)),
      'salary_month' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'start'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'end'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'bankrekening' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'girorekening' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'afstand_km'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('employees_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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
      'firstname'    => 'Text',
      'middlename'   => 'Text',
      'lastname'     => 'Text',
      'title'        => 'Text',
      'extension'    => 'Text',
      'workphone'    => 'Text',
      'homephone'    => 'Text',
      'mobilephone'  => 'Text',
      'login'        => 'Text',
      'pwd'          => 'Text',
      'uid'          => 'Text',
      'groupid'      => 'Number',
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
      'bankrekening' => 'Number',
      'girorekening' => 'Number',
      'afstand_km'   => 'Number',
    );
  }
}
