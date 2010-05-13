<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Allow filter form base class.
 *
 * @package    filters
 * @subpackage Allow *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseAllowFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'      => new sfWidgetFormFilterInput(),
      'grant_shipment' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'grant_shipment' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('allow_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Allow';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'contactid'      => 'Number',
      'grant_shipment' => 'Number',
    );
  }
}