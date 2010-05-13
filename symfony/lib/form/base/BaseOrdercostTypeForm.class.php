<?php

/**
 * OrdercostType form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseOrdercostTypeForm extends BaseFormPropel
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
      'ordercostid'       => new sfValidatorPropelChoice(array('model' => 'OrdercostType', 'column' => 'ordercostid', 'required' => false)),
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
