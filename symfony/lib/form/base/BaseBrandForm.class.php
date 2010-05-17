<?php

/**
 * Brand form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBrandForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'brand_id' => new sfWidgetFormInputHidden(),
      'name'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'brand_id' => new sfValidatorPropelChoice(array('model' => 'Brand', 'column' => 'brand_id', 'required' => false)),
      'name'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('brand[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Brand';
  }


}
