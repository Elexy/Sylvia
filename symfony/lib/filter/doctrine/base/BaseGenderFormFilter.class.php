<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Gender filter form base class.
 *
 * @package    filters
 * @subpackage Gender *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseGenderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'gender' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'gender' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gender_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gender';
  }

  public function getFields()
  {
    return array(
      'gender' => 'Text',
      'id'     => 'Number',
    );
  }
}