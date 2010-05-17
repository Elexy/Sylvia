<?php

/**
 * Brand form base class.
 *
 * @method Brand getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBrandForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'brand_id' => new sfWidgetFormInputHidden(),
      'name'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'brand_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'brand_id', 'required' => false)),
      'name'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('brand[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Brand';
  }

}
