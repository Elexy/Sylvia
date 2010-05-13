<?php

/**
 * RmaProductLocation form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseRmaProductLocationForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'state_id'   => new sfWidgetFormInputText(),
      'state_text' => new sfWidgetFormInputText(),
      'id'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'state_id'   => new sfValidatorInteger(),
      'state_text' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'id'         => new sfValidatorPropelChoice(array('model' => 'RmaProductLocation', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'RmaProductLocation', 'column' => array('state_id')))
    );

    $this->widgetSchema->setNameFormat('rma_product_location[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RmaProductLocation';
  }


}
