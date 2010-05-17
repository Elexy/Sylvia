<?php

/**
 * ProductHistory form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseProductHistoryForm extends BaseFormPropel
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
      'producthistoryid' => new sfValidatorPropelChoice(array('model' => 'ProductHistory', 'column' => 'producthistoryid', 'required' => false)),
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
