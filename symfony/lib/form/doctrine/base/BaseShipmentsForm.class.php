<?php

/**
 * Shipments form base class.
 *
 * @package    form
 * @subpackage shipments
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseShipmentsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'shipment_id' => new sfWidgetFormInputHidden(),
      'adressid'    => new sfWidgetFormInputText(),
      'invoiceid'   => new sfWidgetFormInputText(),
      'tracking'    => new sfWidgetFormInputText(),
      'dummy'       => new sfWidgetFormDateTime(),
      'cancel'      => new sfWidgetFormInputText(),
      'email_send'  => new sfWidgetFormInputText(),
      'start_date'  => new sfWidgetFormDateTime(),
      'ship_date'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'shipment_id' => new sfValidatorDoctrineChoice(array('model' => 'Shipments', 'column' => 'shipment_id', 'required' => false)),
      'adressid'    => new sfValidatorInteger(),
      'invoiceid'   => new sfValidatorInteger(array('required' => false)),
      'tracking'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'dummy'       => new sfValidatorDateTime(),
      'cancel'      => new sfValidatorInteger(),
      'email_send'  => new sfValidatorInteger(array('required' => false)),
      'start_date'  => new sfValidatorDateTime(array('required' => false)),
      'ship_date'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Shipments';
  }

}