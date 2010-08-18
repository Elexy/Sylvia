<?php

/**
 * Shippers form base class.
 *
 * @method Shippers getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseShippersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'shipperid'   => new sfWidgetFormInputHidden(),
      'companyname' => new sfWidgetFormInputText(),
      'phone'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'shipperid'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'shipperid', 'required' => false)),
      'companyname' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'phone'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shippers[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Shippers';
  }

}
