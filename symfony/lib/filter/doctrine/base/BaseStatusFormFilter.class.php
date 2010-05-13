<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Status filter form base class.
 *
 * @package    filters
 * @subpackage Status *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseStatusFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'statustext' => new sfWidgetFormFilterInput(),
      'category'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'statustext' => new sfValidatorPass(array('required' => false)),
      'category'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('status_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Status';
  }

  public function getFields()
  {
    return array(
      'statusid'   => 'Number',
      'statustext' => 'Text',
      'category'   => 'Number',
    );
  }
}