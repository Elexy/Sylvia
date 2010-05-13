<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Languages filter form base class.
 *
 * @package    filters
 * @subpackage Languages *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseLanguagesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'language'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'language'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('languages_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Languages';
  }

  public function getFields()
  {
    return array(
      'languageid' => 'Number',
      'language'   => 'Text',
    );
  }
}