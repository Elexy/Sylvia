<?php

/**
 * SwitchboardItems form base class.
 *
 * @package    form
 * @subpackage switchboard_items
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseSwitchboardItemsForm extends BaseFormDoctrine
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
      'id'            => new sfValidatorDoctrineChoice(array('model' => 'SwitchboardItems', 'column' => 'id', 'required' => false)),
      'itemnumber'    => new sfValidatorInteger(array('required' => false)),
      'dummy'         => new sfValidatorDateTime(),
      'switchboardid' => new sfValidatorInteger(array('required' => false)),
      'itemtext'      => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'command'       => new sfValidatorInteger(array('required' => false)),
      'argument'      => new sfValidatorString(array('max_length' => 35, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('switchboard_items[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SwitchboardItems';
  }

}