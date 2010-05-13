<?php

/**
 * PoDetails form base class.
 *
 * @package    form
 * @subpackage po_details
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePoDetailsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'podetailsid'    => new sfWidgetFormInputHidden(),
      'poid'           => new sfWidgetFormInputText(),
      'productid'      => new sfWidgetFormInputText(),
      'unitprice'      => new sfWidgetFormInputText(),
      'to_deliver'     => new sfWidgetFormInputText(),
      'tax_percentage' => new sfWidgetFormInputText(),
      'added_cost'     => new sfWidgetFormInputText(),
      'podate'         => new sfWidgetFormDate(),
      'quantity'       => new sfWidgetFormInputText(),
      'last_exp'       => new sfWidgetFormDate(),
      'comments'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'podetailsid'    => new sfValidatorDoctrineChoice(array('model' => 'PoDetails', 'column' => 'podetailsid', 'required' => false)),
      'poid'           => new sfValidatorInteger(array('required' => false)),
      'productid'      => new sfValidatorInteger(),
      'unitprice'      => new sfValidatorNumber(),
      'to_deliver'     => new sfValidatorInteger(array('required' => false)),
      'tax_percentage' => new sfValidatorNumber(),
      'added_cost'     => new sfValidatorNumber(),
      'podate'         => new sfValidatorDate(array('required' => false)),
      'quantity'       => new sfValidatorInteger(array('required' => false)),
      'last_exp'       => new sfValidatorDate(array('required' => false)),
      'comments'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('po_details[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PoDetails';
  }

}