<?php

/**
 * Serialnumbers filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSerialnumbersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'inventory_transactionid' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'serial'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'inventory_transactionid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'serial'                  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('serialnumbers_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Serialnumbers';
  }

  public function getFields()
  {
    return array(
      'inventory_transactionid' => 'Number',
      'serial'                  => 'Text',
      'serialrecordid'          => 'Number',
    );
  }
}
