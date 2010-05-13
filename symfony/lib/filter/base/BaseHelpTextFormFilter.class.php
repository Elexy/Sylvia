<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * HelpText filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseHelpTextFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'file'            => new sfWidgetFormFilterInput(),
      'title'           => new sfWidgetFormFilterInput(),
      'text_dutch'      => new sfWidgetFormFilterInput(),
      'last_changed_by' => new sfWidgetFormFilterInput(),
      'change_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'file'            => new sfValidatorPass(array('required' => false)),
      'title'           => new sfValidatorPass(array('required' => false)),
      'text_dutch'      => new sfValidatorPass(array('required' => false)),
      'last_changed_by' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'change_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('help_text_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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
