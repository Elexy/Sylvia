<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Country filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCountryFormFilter extends BaseFormFilterPropel
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
