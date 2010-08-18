<?php

/**
 * Adrestitels form base class.
 *
 * @method Adrestitels getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAdrestitelsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'titelid' => new sfWidgetFormInputHidden(),
      'titel'   => new sfWidgetFormInputText(),
      'dummy'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'titelid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'titelid', 'required' => false)),
      'titel'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'dummy'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('adrestitels[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adrestitels';
  }

}
