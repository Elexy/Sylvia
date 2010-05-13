<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Menucategory filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseMenucategoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'          => new sfWidgetFormFilterInput(),
      'orderflag'     => new sfWidgetFormFilterInput(),
      'menu'          => new sfWidgetFormFilterInput(),
      'description'   => new sfWidgetFormFilterInput(),
      'access_s'      => new sfWidgetFormFilterInput(),
      'access_a'      => new sfWidgetFormFilterInput(),
      'access_v'      => new sfWidgetFormFilterInput(),
      'access_r'      => new sfWidgetFormFilterInput(),
      'setup_s'       => new sfWidgetFormFilterInput(),
      'setup_a'       => new sfWidgetFormFilterInput(),
      'setup_v'       => new sfWidgetFormFilterInput(),
      'setup_r'       => new sfWidgetFormFilterInput(),
      'supervisor'    => new sfWidgetFormFilterInput(),
      'nonsupervisor' => new sfWidgetFormFilterInput(),
      'extvend'       => new sfWidgetFormFilterInput(),
      'extcust'       => new sfWidgetFormFilterInput(),
      'nonext'        => new sfWidgetFormFilterInput(),
      'companyid'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'          => new sfValidatorPass(array('required' => false)),
      'orderflag'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'menu'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'   => new sfValidatorPass(array('required' => false)),
      'access_s'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'access_a'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'access_v'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'access_r'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'setup_s'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'setup_a'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'setup_v'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'setup_r'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'supervisor'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nonsupervisor' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'extvend'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'extcust'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nonext'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'companyid'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('menucategory_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menucategory';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'name'          => 'Text',
      'orderflag'     => 'Number',
      'menu'          => 'Number',
      'description'   => 'Text',
      'access_s'      => 'Number',
      'access_a'      => 'Number',
      'access_v'      => 'Number',
      'access_r'      => 'Number',
      'setup_s'       => 'Number',
      'setup_a'       => 'Number',
      'setup_v'       => 'Number',
      'setup_r'       => 'Number',
      'supervisor'    => 'Number',
      'nonsupervisor' => 'Number',
      'extvend'       => 'Number',
      'extcust'       => 'Number',
      'nonext'        => 'Number',
      'companyid'     => 'Number',
    );
  }
}
