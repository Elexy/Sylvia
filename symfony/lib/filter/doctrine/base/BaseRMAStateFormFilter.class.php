<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * RMAState filter form base class.
 *
 * @package    filters
 * @subpackage RMAState *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseRMAStateFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'state_text' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'state_text' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_state_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RMAState';
  }

  public function getFields()
  {
    return array(
      'state_id'   => 'Number',
      'state_text' => 'Text',
    );
  }
}