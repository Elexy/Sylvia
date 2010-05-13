<?php

/**
 * PersonenType form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePersonenTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'personen_type_id' => new sfWidgetFormInputHidden(),
      'desctription'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'personen_type_id' => new sfValidatorPropelChoice(array('model' => 'PersonenType', 'column' => 'personen_type_id', 'required' => false)),
      'desctription'     => new sfValidatorString(array('max_length' => 15)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'PersonenType', 'column' => array('personen_type_id')))
    );

    $this->widgetSchema->setNameFormat('personen_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PersonenType';
  }


}
