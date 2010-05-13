<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Genuser filter form base class.
 *
 * @package    filters
 * @subpackage Genuser *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseGenuserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'uid'            => new sfWidgetFormFilterInput(),
      'raccess_s'      => new sfWidgetFormFilterInput(),
      'raccess_a'      => new sfWidgetFormFilterInput(),
      'raccess_v'      => new sfWidgetFormFilterInput(),
      'raccess_r'      => new sfWidgetFormFilterInput(),
      'waccess_s'      => new sfWidgetFormFilterInput(),
      'waccess_a'      => new sfWidgetFormFilterInput(),
      'waccess_v'      => new sfWidgetFormFilterInput(),
      'waccess_r'      => new sfWidgetFormFilterInput(),
      'saccess_s'      => new sfWidgetFormFilterInput(),
      'saccess_a'      => new sfWidgetFormFilterInput(),
      'saccess_v'      => new sfWidgetFormFilterInput(),
      'saccess_r'      => new sfWidgetFormFilterInput(),
      'supervisor'     => new sfWidgetFormFilterInput(),
      'email'          => new sfWidgetFormFilterInput(),
      'logon_attempts' => new sfWidgetFormFilterInput(),
      'active'         => new sfWidgetFormFilterInput(),
      'stylesheetid'   => new sfWidgetFormFilterInput(),
      'deflanguage'    => new sfWidgetFormFilterInput(),
      'contactid'      => new sfWidgetFormFilterInput(),
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