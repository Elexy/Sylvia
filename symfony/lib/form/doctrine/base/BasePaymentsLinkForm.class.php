<?php

/**
 * PaymentsLink form base class.
 *
 * @method PaymentsLink getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePaymentsLinkForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'link_id'           => new sfWidgetFormInputHidden(),
      'banktransactionid' => new sfWidgetFormInputText(),
      'invoiceid'         => new sfWidgetFormInputText(),
      'link_amount'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'link_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'link_id', 'required' => false)),
      'banktransactionid' => new sfValidatorInteger(array('required' => false)),
      'invoiceid'         => new sfValidatorInteger(array('required' => false)),
      'link_amount'       => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('payments_link[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentsLink';
  }

}
