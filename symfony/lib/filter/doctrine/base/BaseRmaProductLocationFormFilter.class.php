<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * RmaProductLocation filter form base class.
 *
 * @package    filters
 * @subpackage RmaProductLocation *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseRmaProductLocationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'state_text' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'state_text' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_product_location_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RmaProductLocation';
  }

  public function getFields()
  {
    return array(
      'state_id'   => 'Number',
      'state_text' => 'Text',
    );
  }
}