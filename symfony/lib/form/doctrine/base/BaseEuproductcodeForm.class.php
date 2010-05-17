<?php

/**
 * Euproductcode form base class.
 *
 * @method Euproductcode getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseEuproductcodeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'euproductcode' => new sfWidgetFormInputHidden(),
      'taxrate'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'euproductcode' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'euproductcode', 'required' => false)),
      'taxrate'       => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('euproductcode[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Euproductcode';
  }

}
