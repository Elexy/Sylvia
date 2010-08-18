<?php

/**
 * ProductHistory form base class.
 *
 * @method ProductHistory getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProductHistoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'producthistoryid' => new sfWidgetFormInputHidden(),
      'productid'        => new sfWidgetFormInputText(),
      'employee'         => new sfWidgetFormInputText(),
      'old_value'        => new sfWidgetFormInputText(),
      'new_value'        => new sfWidgetFormInputText(),
      'date_updated_at'  => new sfWidgetFormDateTime(),
      'fieldname'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'producthistoryid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'producthistoryid', 'required' => false)),
      'productid'        => new sfValidatorInteger(array('required' => false)),
      'employee'         => new sfValidatorInteger(array('required' => false)),
      'old_value'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'new_value'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'date_updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'fieldname'        => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductHistory';
  }

}
