<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * SwitchboardItems filter form base class.
 *
 * @package    filters
 * @subpackage SwitchboardItems *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseSwitchboardItemsFormFilter extends BaseFormFilterDoctrine
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
      'dummy'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'switchboardid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'itemtext'      => new sfValidatorPass(array('required' => false)),
      'command'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'argument'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('switchboard_items_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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