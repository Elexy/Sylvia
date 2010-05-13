<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * FieldsTextLanguages filter form base class.
 *
 * @package    filters
 * @subpackage FieldsTextLanguages *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseFieldsTextLanguagesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'categoryid' => new sfWidgetFormFilterInput(),
      'text'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'categoryid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'text'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fields_text_languages_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FieldsTextLanguages';
  }

  public function getFields()
  {
    return array(
      'fieldid'    => 'Number',
      'categoryid' => 'Number',
      'languageid' => 'Number',
      'text'       => 'Text',
    );
  }
}