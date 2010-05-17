<?php

/**
 * Allow filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAllowFormFilter extends BaseFormFilterDoctrine
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

    $this->setupInheritance();

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
