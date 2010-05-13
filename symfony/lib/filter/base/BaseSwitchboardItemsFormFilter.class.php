<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SwitchboardItems filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSwitchboardItemsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'switchboardid' => new sfWidgetFormFilterInput(),
      'itemnumber'    => new sfWidgetFormFilterInput(),
      'itemtext'      => new sfWidgetFormFilterInput(),
      'command'       => new sfWidgetFormFilterInput(),
      'argument'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'switchboardid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'itemnumber'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'switchboardid' => 'Number',
      'itemnumber'    => 'Number',
      'itemtext'      => 'Text',
      'command'       => 'Number',
      'argument'      => 'Text',
      'id'            => 'Number',
    );
  }
}
