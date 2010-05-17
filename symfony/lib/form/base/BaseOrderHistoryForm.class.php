<?php

/**
 * OrderHistory form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseOrderHistoryForm extends BaseFormPropel
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
      'orderhistoryid' => new sfValidatorPropelChoice(array('model' => 'OrderHistory', 'column' => 'orderhistoryid', 'required' => false)),
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
