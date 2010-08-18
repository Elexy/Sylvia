<?php

/**
 * ContactTypes form base class.
 *
 * @method ContactTypes getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseContactTypesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contacttypeid' => new sfWidgetFormInputHidden(),
      'dummy'         => new sfWidgetFormDateTime(),
      'contacttype'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'contacttypeid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'contacttypeid', 'required' => false)),
      'dummy'         => new sfValidatorDateTime(),
      'contacttype'   => new sfValidatorString(array('max_length' => 6, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contact_types[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactTypes';
  }

}
