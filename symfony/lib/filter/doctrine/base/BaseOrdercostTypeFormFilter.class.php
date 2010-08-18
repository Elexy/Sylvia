<?php

/**
 * OrdercostType filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseOrdercostTypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'description'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'webordercost'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'minweborderamount' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ordercost'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'minorderamount'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'shippingcost'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'realcost'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'description'       => new sfValidatorPass(array('required' => false)),
      'webordercost'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'minweborderamount' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ordercost'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'minorderamount'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'shippingcost'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'realcost'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ordercost_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrdercostType';
  }

  public function getFields()
  {
    return array(
      'ordercostid'       => 'Number',
      'description'       => 'Text',
      'webordercost'      => 'Number',
      'minweborderamount' => 'Number',
      'ordercost'         => 'Number',
      'minorderamount'    => 'Number',
      'shippingcost'      => 'Number',
      'realcost'          => 'Number',
    );
  }
}
