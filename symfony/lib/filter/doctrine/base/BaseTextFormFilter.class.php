<?php

/**
 * Text filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTextFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'categoryid' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'languageid' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subject'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'text'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'categoryid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'languageid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'subject'    => new sfValidatorPass(array('required' => false)),
      'text'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('text_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
