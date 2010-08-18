<?php

/**
 * Status filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseStatusFormFilter extends BaseFormFilterDoctrine
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

    $this->setupInheritance();

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
