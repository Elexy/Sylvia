<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Gender filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseGenderFormFilter extends BaseFormFilterPropel
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
