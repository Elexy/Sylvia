<?php

/**
 * Genuser filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseGenuserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'uid'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'raccess_s'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'raccess_a'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'raccess_v'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'raccess_r'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'waccess_s'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'waccess_a'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'waccess_v'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'waccess_r'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'saccess_s'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'saccess_a'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'saccess_v'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'saccess_r'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'supervisor'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'logon_attempts' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'active'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'stylesheetid'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deflanguage'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'contactid'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'employee_id'    => new sfWidgetFormFilterInput(),
      'pwd'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'uid'            => new sfValidatorPass(array('required' => false)),
      'raccess_s'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'raccess_a'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'raccess_v'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'raccess_r'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'waccess_s'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'waccess_a'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'waccess_v'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'waccess_r'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'saccess_s'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'saccess_a'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'saccess_v'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'saccess_r'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'supervisor'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email'          => new sfValidatorPass(array('required' => false)),
      'logon_attempts' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'active'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stylesheetid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deflanguage'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'contactid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'employee_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pwd'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('genuser_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Genuser';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'uid'            => 'Text',
      'raccess_s'      => 'Number',
      'raccess_a'      => 'Number',
      'raccess_v'      => 'Number',
      'raccess_r'      => 'Number',
      'waccess_s'      => 'Number',
      'waccess_a'      => 'Number',
      'waccess_v'      => 'Number',
      'waccess_r'      => 'Number',
      'saccess_s'      => 'Number',
      'saccess_a'      => 'Number',
      'saccess_v'      => 'Number',
      'saccess_r'      => 'Number',
      'supervisor'     => 'Number',
      'email'          => 'Text',
      'logon_attempts' => 'Number',
      'active'         => 'Number',
      'stylesheetid'   => 'Number',
      'deflanguage'    => 'Number',
      'contactid'      => 'Number',
      'employee_id'    => 'Number',
      'pwd'            => 'Text',
    );
  }
}
