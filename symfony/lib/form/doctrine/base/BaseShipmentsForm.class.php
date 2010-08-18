<?php

/**
 * Shipments form base class.
 *
 * @method Shipments getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseShipmentsForm extends BaseFormDoctrine
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
      'shipment_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'shipment_id', 'required' => false)),
      'adressid'    => new sfValidatorInteger(array('required' => false)),
      'invoiceid'   => new sfValidatorInteger(array('required' => false)),
      'tracking'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'dummy'       => new sfValidatorDateTime(),
      'cancel'      => new sfValidatorInteger(array('required' => false)),
      'email_send'  => new sfValidatorInteger(array('required' => false)),
      'start_date'  => new sfValidatorDateTime(array('required' => false)),
      'ship_date'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shipments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Shipments';
  }

}
