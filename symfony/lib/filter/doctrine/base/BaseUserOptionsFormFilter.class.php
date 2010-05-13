<?php

/**
 * UserOptions filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseUserOptionsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid'          => new sfWidgetFormFilterInput(),
      'brancheadmin'    => new sfWidgetFormFilterInput(),
      'rma'             => new sfWidgetFormFilterInput(),
      'purchase'        => new sfWidgetFormFilterInput(),
      'stock'           => new sfWidgetFormFilterInput(),
      'catalogus'       => new sfWidgetFormFilterInput(),
      'add_users'       => new sfWidgetFormFilterInput(),
      'retail_price'    => new sfWidgetFormFilterInput(),
      'warehouseprice'  => new sfWidgetFormFilterInput(),
      'template'        => new sfWidgetFormFilterInput(),
      'rights'          => new sfWidgetFormFilterInput(),
      'margins'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'userid'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'brancheadmin'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rma'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'purchase'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stock'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'catalogus'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'add_users'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'retail_price'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'warehouseprice'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'template'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rights'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'margins'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('user_options_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserOptions';
  }

  public function getFields()
  {
    return array(
      'user_options_id' => 'Number',
      'userid'          => 'Number',
      'brancheadmin'    => 'Number',
      'rma'             => 'Number',
      'purchase'        => 'Number',
      'stock'           => 'Number',
      'catalogus'       => 'Number',
      'add_users'       => 'Number',
      'retail_price'    => 'Number',
      'warehouseprice'  => 'Number',
      'template'        => 'Number',
      'rights'          => 'Number',
      'margins'         => 'Number',
    );
  }
}
