<?php

/**
 * SwitchboardItems filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSwitchboardItemsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'itemnumber'    => new sfWidgetFormFilterInput(),
      'dummy'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'switchboardid' => new sfWidgetFormFilterInput(),
      'itemtext'      => new sfWidgetFormFilterInput(),
      'command'       => new sfWidgetFormFilterInput(),
      'argument'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'itemnumber'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'switchboardid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'itemtext'      => new sfValidatorPass(array('required' => false)),
      'command'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'argument'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('switchboard_items_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SwitchboardItems';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'itemnumber'    => 'Number',
      'dummy'         => 'Date',
      'switchboardid' => 'Number',
      'itemtext'      => 'Text',
      'command'       => 'Number',
      'argument'      => 'Text',
    );
  }
}
