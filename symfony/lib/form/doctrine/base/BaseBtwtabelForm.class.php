<?php

/**
 * Btwtabel form base class.
 *
 * @method Btwtabel getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBtwtabelForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'btw_class'     => new sfWidgetFormInputHidden(),
      'btwpercentage' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'btw_class'     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'btw_class', 'required' => false)),
      'btwpercentage' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('btwtabel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Btwtabel';
  }

}
