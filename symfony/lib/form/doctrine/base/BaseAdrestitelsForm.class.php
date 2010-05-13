<?php

/**
 * Adrestitels form base class.
 *
 * @package    form
 * @subpackage adrestitels
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseAdrestitelsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'titelid' => new sfWidgetFormInputHidden(),
      'titel'   => new sfWidgetFormInputText(),
      'dummy'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'titelid' => new sfValidatorDoctrineChoice(array('model' => 'Adrestitels', 'column' => 'titelid', 'required' => false)),
      'titel'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'dummy'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('adrestitels[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adrestitels';
  }

}