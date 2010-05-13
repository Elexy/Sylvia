<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ProductHistory filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseProductHistoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'productid'        => new sfWidgetFormFilterInput(),
      'employee'         => new sfWidgetFormFilterInput(),
      'old_value'        => new sfWidgetFormFilterInput(),
      'new_value'        => new sfWidgetFormFilterInput(),
      'date_modified'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fieldname'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'productid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'employee'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'old_value'        => new sfValidatorPass(array('required' => false)),
      'new_value'        => new sfValidatorPass(array('required' => false)),
      'date_modified'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fieldname'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product_history_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductHistory';
  }

  public function getFields()
  {
    return array(
      'producthistoryid' => 'Number',
      'productid'        => 'Number',
      'employee'         => 'Number',
      'old_value'        => 'Text',
      'new_value'        => 'Text',
      'date_modified'    => 'Date',
      'fieldname'        => 'Text',
    );
  }
}
