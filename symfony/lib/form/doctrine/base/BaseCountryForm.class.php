<?php

/**
 * Country form base class.
 *
 * @package    form
 * @subpackage country
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCountryForm extends BaseFormDoctrine
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
      'code'           => new sfValidatorDoctrineChoice(array('model' => 'Country', 'column' => 'code', 'required' => false)),
      'country'        => new sfValidatorString(array('max_length' => 50)),
      'eu_country'     => new sfValidatorInteger(array('required' => false)),
      'iso_code'       => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'zipcode_format' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }

}