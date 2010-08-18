<?php

/**
 * Country form base class.
 *
 * @method Country getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCountryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'           => new sfWidgetFormInputHidden(),
      'country'        => new sfWidgetFormInputText(),
      'eu_country'     => new sfWidgetFormInputText(),
      'iso_code'       => new sfWidgetFormInputText(),
      'zipcode_format' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'code'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'code', 'required' => false)),
      'country'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'eu_country'     => new sfValidatorInteger(array('required' => false)),
      'iso_code'       => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'zipcode_format' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }

}
