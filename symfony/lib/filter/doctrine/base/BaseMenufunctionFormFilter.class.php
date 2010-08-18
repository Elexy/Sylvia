<?php

/**
 * Menufunction filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMenufunctionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'menucategoryid' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'imagename'      => new sfWidgetFormFilterInput(),
      'link'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orderflag'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'access_s'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'access_a'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'access_v'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'access_r'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'setup_s'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'setup_a'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'setup_v'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'setup_r'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'supervisor'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nonsupervisor'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'extvend'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'extcust'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nonext'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'menucategoryid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'           => new sfValidatorPass(array('required' => false)),
      'imagename'      => new sfValidatorPass(array('required' => false)),
      'link'           => new sfValidatorPass(array('required' => false)),
      'orderflag'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'access_s'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'access_a'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'access_v'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'access_r'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'setup_s'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'setup_a'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'setup_v'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'setup_r'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'supervisor'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nonsupervisor'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'extvend'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'extcust'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nonext'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('menufunction_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Menufunction';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'menucategoryid' => 'Number',
      'name'           => 'Text',
      'imagename'      => 'Text',
      'link'           => 'Text',
      'orderflag'      => 'Number',
      'access_s'       => 'Number',
      'access_a'       => 'Number',
      'access_v'       => 'Number',
      'access_r'       => 'Number',
      'setup_s'        => 'Number',
      'setup_a'        => 'Number',
      'setup_v'        => 'Number',
      'setup_r'        => 'Number',
      'supervisor'     => 'Number',
      'nonsupervisor'  => 'Number',
      'extvend'        => 'Number',
      'extcust'        => 'Number',
      'nonext'         => 'Number',
    );
  }
}
