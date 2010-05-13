<?php

/**
 * OrdercostType form base class.
 *
 * @method OrdercostType getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseOrdercostTypeForm extends BaseFormDoctrine
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
      'ordercostid'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'ordercostid', 'required' => false)),
      'description'       => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'webordercost'      => new sfValidatorNumber(array('required' => false)),
      'minweborderamount' => new sfValidatorNumber(array('required' => false)),
      'ordercost'         => new sfValidatorNumber(array('required' => false)),
      'minorderamount'    => new sfValidatorNumber(array('required' => false)),
      'shippingcost'      => new sfValidatorNumber(array('required' => false)),
      'realcost'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ordercost_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrdercostType';
  }

}
