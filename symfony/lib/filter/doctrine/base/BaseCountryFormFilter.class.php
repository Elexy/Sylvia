<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Country filter form base class.
 *
 * @package    filters
 * @subpackage Country *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseCountryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'country'        => new sfWidgetFormFilterInput(),
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