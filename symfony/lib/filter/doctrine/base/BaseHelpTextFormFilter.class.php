<?php

/**
 * HelpText filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseHelpTextFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'text_dutch'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_changed_by' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'change_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'file'            => new sfValidatorPass(array('required' => false)),
      'title'           => new sfValidatorPass(array('required' => false)),
      'text_dutch'      => new sfValidatorPass(array('required' => false)),
      'last_changed_by' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'change_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('help_text_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HelpText';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'file'            => 'Text',
      'title'           => 'Text',
      'text_dutch'      => 'Text',
      'last_changed_by' => 'Number',
      'change_date'     => 'Date',
    );
  }
}
