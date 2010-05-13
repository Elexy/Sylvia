<?php

/**
 * Box form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBoxForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'box_id'           => new sfWidgetFormInputHidden(),
      'shipment_id'      => new sfWidgetFormInputText(),
      'tracking'         => new sfWidgetFormInputText(),
      'weight_kg'        => new sfWidgetFormInputText(),
      'length_cm'        => new sfWidgetFormInputText(),
      'width_cm'         => new sfWidgetFormInputText(),
      'height_cm'        => new sfWidgetFormInputText(),
      'volume_weight_kg' => new sfWidgetFormInputText(),
      'box_number'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'box_id'           => new sfValidatorPropelChoice(array('model' => 'Box', 'column' => 'box_id', 'required' => false)),
      'shipment_id'      => new sfValidatorInteger(array('required' => false)),
      'tracking'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'weight_kg'        => new sfValidatorNumber(array('required' => false)),
      'length_cm'        => new sfValidatorNumber(array('required' => false)),
      'width_cm'         => new sfValidatorNumber(array('required' => false)),
      'height_cm'        => new sfValidatorNumber(array('required' => false)),
      'volume_weight_kg' => new sfValidatorNumber(array('required' => false)),
      'box_number'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('box[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Box';
  }


}
