<?php

/**
 * SwitchboardItems form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSwitchboardItemsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'switchboardid' => new sfWidgetFormInput(),
      'itemnumber'    => new sfWidgetFormInput(),
      'itemtext'      => new sfWidgetFormInput(),
      'command'       => new sfWidgetFormInput(),
      'argument'      => new sfWidgetFormInput(),
      'id'            => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'switchboardid' => new sfValidatorInteger(array('required' => false)),
      'itemnumber'    => new sfValidatorInteger(array('required' => false)),
      'itemtext'      => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'command'       => new sfValidatorInteger(array('required' => false)),
      'argument'      => new sfValidatorString(array('max_length' => 35, 'required' => false)),
      'id'            => new sfValidatorPropelChoice(array('model' => 'SwitchboardItems', 'column' => 'id', 'required' => false)),
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
