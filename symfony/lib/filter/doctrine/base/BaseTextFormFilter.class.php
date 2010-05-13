<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Text filter form base class.
 *
 * @package    filters
 * @subpackage Text *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseTextFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'categoryid' => new sfWidgetFormFilterInput(),
      'languageid' => new sfWidgetFormFilterInput(),
      'subject'    => new sfWidgetFormFilterInput(),
      'text'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'categoryid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'languageid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'subject'    => new sfValidatorPass(array('required' => false)),
      'text'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('text_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Text';
  }

  public function getFields()
  {
    return array(
      'textid'     => 'Number',
      'categoryid' => 'Number',
      'languageid' => 'Number',
      'subject'    => 'Text',
      'text'       => 'Text',
    );
  }
}