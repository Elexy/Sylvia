<?php

/**
 * Shippers form base class.
 *
 * @package    form
 * @subpackage shippers
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseShippersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'shipperid'   => new sfWidgetFormInputHidden(),
      'companyname' => new sfWidgetFormInputText(),
      'phone'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'shipperid'   => new sfValidatorDoctrineChoice(array('model' => 'Shippers', 'column' => 'shipperid', 'required' => false)),
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