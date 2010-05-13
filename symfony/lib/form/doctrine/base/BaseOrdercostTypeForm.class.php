<?php

/**
 * OrdercostType form base class.
 *
 * @package    form
 * @subpackage ordercost_type
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseOrdercostTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ordercostid'       => new sfWidgetFormInputHidden(),
      'description'       => new sfWidgetFormInputText(),
      'webordercost'      => new sfWidgetFormInputText(),
      'minweborderamount' => new sfWidgetFormInputText(),
      'ordercost'         => new sfWidgetFormInputText(),
      'minorderamount'    => new sfWidgetFormInputText(),
      'shippingcost'      => new sfWidgetFormInputText(),
      'realcost'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'ordercostid'       => new sfValidatorDoctrineChoice(array('model' => 'OrdercostType', 'column' => 'ordercostid', 'required' => false)),
      'description'       => new sfValidatorString(array('max_length' => 25)),
      'webordercost'      => new sfValidatorNumber(),
      'minweborderamount' => new sfValidatorNumber(),
      'ordercost'         => new sfValidatorNumber(),
      'minorderamount'    => new sfValidatorNumber(),
      'shippingcost'      => new sfValidatorNumber(),
      'realcost'          => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('ordercost_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrdercostType';
  }

}