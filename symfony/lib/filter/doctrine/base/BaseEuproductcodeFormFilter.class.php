<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Euproductcode filter form base class.
 *
 * @package    filters
 * @subpackage Euproductcode *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseEuproductcodeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'taxrate'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'taxrate'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('euproductcode_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Euproductcode';
  }

  public function getFields()
  {
    return array(
      'euproductcode' => 'Number',
      'taxrate'       => 'Number',
    );
  }
}