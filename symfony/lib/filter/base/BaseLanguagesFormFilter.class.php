<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Languages filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseLanguagesFormFilter extends BaseFormFilterPropel
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
