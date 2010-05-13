<?php

/**
 * Status form base class.
 *
 * @method Status getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseStatusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'statusid'   => new sfWidgetFormInputHidden(),
      'statustext' => new sfWidgetFormInputText(),
      'category'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'statusid'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'statusid', 'required' => false)),
      'statustext' => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'category'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Status';
  }

}
