<?php

/**
 * PersonenType form base class.
 *
 * @package    form
 * @subpackage personen_type
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePersonenTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'personen_type_id' => new sfWidgetFormInputHidden(),
      'desctription'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'personen_type_id' => new sfValidatorDoctrineChoice(array('model' => 'PersonenType', 'column' => 'personen_type_id', 'required' => false)),
      'desctription'     => new sfValidatorString(array('max_length' => 15)),
    ));

    $this->widgetSchema->setNameFormat('personen_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PersonenType';
  }

}