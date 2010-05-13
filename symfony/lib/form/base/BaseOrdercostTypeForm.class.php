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
      'description'       => new sfWidgetFormInput(),
      'webordercost'      => new sfWidgetFormInput(),
      'minweborderamount' => new sfWidgetFormInput(),
      'ordercost'         => new sfWidgetFormInput(),
      'minorderamount'    => new sfWidgetFormInput(),
      'shippingcost'      => new sfWidgetFormInput(),
      'realcost'          => new sfWidgetFormInput(),
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
