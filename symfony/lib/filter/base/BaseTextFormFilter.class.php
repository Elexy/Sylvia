<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Text filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseTextFormFilter extends BaseFormFilterPropel
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
