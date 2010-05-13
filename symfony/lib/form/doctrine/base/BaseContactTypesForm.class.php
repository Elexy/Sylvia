<?php

/**
 * ContactTypes form base class.
 *
 * @package    form
 * @subpackage contact_types
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseContactTypesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contacttypeid' => new sfWidgetFormInputHidden(),
      'dummy'         => new sfWidgetFormDateTime(),
      'contacttype'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'contacttypeid' => new sfValidatorDoctrineChoice(array('model' => 'ContactTypes', 'column' => 'contacttypeid', 'required' => false)),
      'dummy'         => new sfValidatorDateTime(),
      'contacttype'   => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contact_types[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactTypes';
  }

}