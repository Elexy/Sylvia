<?php

/**
 * Shipments form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseShipmentsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'shipment_id' => new sfWidgetFormInputHidden(),
      'adressid'    => new sfWidgetFormInputText(),
      'start_date'  => new sfWidgetFormDateTime(),
      'ship_date'   => new sfWidgetFormDateTime(),
      'invoiceid'   => new sfWidgetFormInputText(),
      'tracking'    => new sfWidgetFormInputText(),
      'cancel'      => new sfWidgetFormInputText(),
      'email_send'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'shipment_id' => new sfValidatorPropelChoice(array('model' => 'Shipments', 'column' => 'shipment_id', 'required' => false)),
      'adressid'    => new sfValidatorInteger(),
      'start_date'  => new sfValidatorDateTime(array('required' => false)),
      'ship_date'   => new sfValidatorDateTime(array('required' => false)),
      'invoiceid'   => new sfValidatorInteger(array('required' => false)),
      'tracking'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'cancel'      => new sfValidatorInteger(),
      'email_send'  => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'Shipments', 'column' => array('shipment_id'))),
        new sfValidatorPropelUnique(array('model' => 'Shipments', 'column' => array('invoiceid'))),
      ))
    );

    $this->widgetSchema->setNameFormat('shipments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Shipments';
  }


}
