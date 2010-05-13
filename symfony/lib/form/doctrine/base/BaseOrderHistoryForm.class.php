<?php

/**
 * OrderHistory form base class.
 *
 * @method OrderHistory getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseOrderHistoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderhistoryid'  => new sfWidgetFormInputHidden(),
      'orderid'         => new sfWidgetFormInputText(),
      'employee'        => new sfWidgetFormInputText(),
      'old_value'       => new sfWidgetFormInputText(),
      'new_value'       => new sfWidgetFormInputText(),
      'date_updated_at' => new sfWidgetFormDateTime(),
      'fieldname'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'orderhistoryid'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'orderhistoryid', 'required' => false)),
      'orderid'         => new sfValidatorInteger(array('required' => false)),
      'employee'        => new sfValidatorInteger(array('required' => false)),
      'old_value'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'new_value'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'date_updated_at' => new sfValidatorDateTime(array('required' => false)),
      'fieldname'       => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('order_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderHistory';
  }

}
