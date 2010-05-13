<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Btwtabel filter form base class.
 *
 * @package    filters
 * @subpackage Btwtabel *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseBtwtabelFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'btwpercentage' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'btwpercentage' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('btwtabel_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Btwtabel';
  }

  public function getFields()
  {
    return array(
      'btw_class'     => 'Number',
      'btwpercentage' => 'Number',
    );
  }
}