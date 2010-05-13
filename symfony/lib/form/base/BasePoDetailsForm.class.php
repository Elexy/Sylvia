<?php

/**
 * PoDetails form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePoDetailsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'podetailsid'    => new sfWidgetFormInputHidden(),
      'poid'           => new sfWidgetFormInputText(),
      'podate'         => new sfWidgetFormDate(),
      'productid'      => new sfWidgetFormInputText(),
      'unitprice'      => new sfWidgetFormInputText(),
      'quantity'       => new sfWidgetFormInputText(),
      'to_deliver'     => new sfWidgetFormInputText(),
      'tax_percentage' => new sfWidgetFormInputText(),
      'added_cost'     => new sfWidgetFormInputText(),
      'last_exp'       => new sfWidgetFormDate(),
      'comments'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'podetailsid'    => new sfValidatorPropelChoice(array('model' => 'PoDetails', 'column' => 'podetailsid', 'required' => false)),
      'poid'           => new sfValidatorInteger(array('required' => false)),
      'podate'         => new sfValidatorDate(array('required' => false)),
      'productid'      => new sfValidatorInteger(),
      'unitprice'      => new sfValidatorNumber(),
      'quantity'       => new sfValidatorInteger(array('required' => false)),
      'to_deliver'     => new sfValidatorInteger(array('required' => false)),
      'tax_percentage' => new sfValidatorNumber(),
      'added_cost'     => new sfValidatorNumber(),
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
