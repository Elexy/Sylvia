<?php

/**
 * FieldsTextLanguages filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFieldsTextLanguagesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'categoryid' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'text'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'categoryid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'text'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fields_text_languages_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
