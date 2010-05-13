<?php

/**
 * Gender form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseGenderForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'gender' => new sfWidgetFormInputText(),
      'id'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'gender' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'id'     => new sfValidatorPropelChoice(array('model' => 'Gender', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Gender', 'column' => array('id')))
    );

    $this->widgetSchema->setNameFormat('gender[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gender';
  }


}
