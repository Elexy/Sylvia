<?php

/**
 * PoDetails form base class.
 *
 * @method PoDetails getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePoDetailsForm extends BaseFormDoctrine
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
      'podetailsid'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'podetailsid', 'required' => false)),
      'poid'           => new sfValidatorInteger(array('required' => false)),
      'productid'      => new sfValidatorInteger(array('required' => false)),
      'unitprice'      => new sfValidatorNumber(array('required' => false)),
      'to_deliver'     => new sfValidatorInteger(array('required' => false)),
      'tax_percentage' => new sfValidatorNumber(array('required' => false)),
      'added_cost'     => new sfValidatorNumber(array('required' => false)),
      'podate'         => new sfValidatorDate(array('required' => false)),
      'quantity'       => new sfValidatorInteger(array('required' => false)),
      'last_exp'       => new sfValidatorDate(array('required' => false)),
      'comments'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('po_details[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PoDetails';
  }

}
