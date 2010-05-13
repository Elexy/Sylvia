<?php

/**
 * Country form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCountryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'           => new sfWidgetFormInputHidden(),
      'country'        => new sfWidgetFormInput(),
      'eu_country'     => new sfWidgetFormInput(),
      'iso_code'       => new sfWidgetFormInput(),
      'zipcode_format' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'code'           => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'code', 'required' => false)),
      'country'        => new sfValidatorString(array('max_length' => 50)),
      'eu_country'     => new sfValidatorInteger(array('required' => false)),
      'iso_code'       => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'zipcode_format' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Country', 'column' => array('code', 'country')))
    );

    $this->widgetSchema->setNameFormat('country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }


}
