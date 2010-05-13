<?php

/**
 * OrderHistory form base class.
 *
 * @package    form
 * @subpackage order_history
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseOrderHistoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'orderhistoryid' => new sfWidgetFormInputHidden(),
      'orderid'        => new sfWidgetFormInputText(),
      'employee'       => new sfWidgetFormInputText(),
      'old_value'      => new sfWidgetFormInputText(),
      'new_value'      => new sfWidgetFormInputText(),
      'date_modified'  => new sfWidgetFormDateTime(),
      'fieldname'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'orderhistoryid' => new sfValidatorDoctrineChoice(array('model' => 'OrderHistory', 'column' => 'orderhistoryid', 'required' => false)),
      'orderid'        => new sfValidatorInteger(),
      'employee'       => new sfValidatorInteger(),
      'old_value'      => new sfValidatorString(array('max_length' => 100)),
      'new_value'      => new sfValidatorString(array('max_length' => 100)),
      'date_modified'  => new sfValidatorDateTime(),
      'fieldname'      => new sfValidatorString(array('max_length' => 25)),
    ));

    $this->widgetSchema->setNameFormat('order_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrderHistory';
  }

}