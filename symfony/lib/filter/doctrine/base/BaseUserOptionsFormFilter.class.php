<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * UserOptions filter form base class.
 *
 * @package    filters
 * @subpackage UserOptions *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseUserOptionsFormFilter extends BaseFormFilterDoctrine
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