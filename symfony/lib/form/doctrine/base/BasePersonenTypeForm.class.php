<?php

/**
 * PersonenType form base class.
 *
 * @method PersonenType getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePersonenTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'personen_type_id' => new sfWidgetFormInputHidden(),
      'desctription'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'personen_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'personen_type_id', 'required' => false)),
      'desctription'     => new sfValidatorString(array('max_length' => 15, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('personen_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PersonenType';
  }

}
