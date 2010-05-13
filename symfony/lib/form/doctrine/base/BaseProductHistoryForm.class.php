<?php

/**
 * ProductHistory form base class.
 *
 * @package    form
 * @subpackage product_history
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseProductHistoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'producthistoryid' => new sfWidgetFormInputHidden(),
      'productid'        => new sfWidgetFormInputText(),
      'employee'         => new sfWidgetFormInputText(),
      'old_value'        => new sfWidgetFormInputText(),
      'new_value'        => new sfWidgetFormInputText(),
      'date_modified'    => new sfWidgetFormDateTime(),
      'fieldname'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'producthistoryid' => new sfValidatorDoctrineChoice(array('model' => 'ProductHistory', 'column' => 'producthistoryid', 'required' => false)),
      'productid'        => new sfValidatorInteger(),
      'employee'         => new sfValidatorInteger(),
      'old_value'        => new sfValidatorString(array('max_length' => 100)),
      'new_value'        => new sfValidatorString(array('max_length' => 100)),
      'date_modified'    => new sfValidatorDateTime(),
      'fieldname'        => new sfValidatorString(array('max_length' => 25)),
    ));

    $this->widgetSchema->setNameFormat('product_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductHistory';
  }

}