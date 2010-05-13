<?php

/**
 * SwitchboardItems form base class.
 *
 * @method SwitchboardItems getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSwitchboardItemsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'itemnumber'    => new sfWidgetFormInputText(),
      'dummy'         => new sfWidgetFormDateTime(),
      'switchboardid' => new sfWidgetFormInputText(),
      'itemtext'      => new sfWidgetFormInputText(),
      'command'       => new sfWidgetFormInputText(),
      'argument'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'itemnumber'    => new sfValidatorInteger(array('required' => false)),
      'dummy'         => new sfValidatorDateTime(),
      'switchboardid' => new sfValidatorInteger(array('required' => false)),
      'itemtext'      => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'command'       => new sfValidatorInteger(array('required' => false)),
      'argument'      => new sfValidatorString(array('max_length' => 35, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('switchboard_items[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SwitchboardItems';
  }

}
