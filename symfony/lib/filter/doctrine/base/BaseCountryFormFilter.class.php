<?php

/**
 * Country filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCountryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'country'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'eu_country'     => new sfWidgetFormFilterInput(),
      'iso_code'       => new sfWidgetFormFilterInput(),
      'zipcode_format' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'country'        => new sfValidatorPass(array('required' => false)),
      'eu_country'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'iso_code'       => new sfValidatorPass(array('required' => false)),
      'zipcode_format' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('country_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }

  public function getFields()
  {
    return array(
      'code'           => 'Text',
      'country'        => 'Text',
      'eu_country'     => 'Number',
      'iso_code'       => 'Text',
      'zipcode_format' => 'Text',
    );
  }
}
