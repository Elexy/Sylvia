<?php

/**
 * Shippers form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseShippersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'shipperid'   => new sfWidgetFormInputHidden(),
      'companyname' => new sfWidgetFormInputText(),
      'phone'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'shipperid'   => new sfValidatorPropelChoice(array('model' => 'Shippers', 'column' => 'shipperid', 'required' => false)),
      'companyname' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'phone'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shippers[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Shippers';
  }


}
