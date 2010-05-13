<?php

/**
 * ContactTypes form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseContactTypesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'contacttypeid' => new sfWidgetFormInputHidden(),
      'contacttype'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'contacttypeid' => new sfValidatorPropelChoice(array('model' => 'ContactTypes', 'column' => 'contacttypeid', 'required' => false)),
      'contacttype'   => new sfValidatorString(array('required' => false)),
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
