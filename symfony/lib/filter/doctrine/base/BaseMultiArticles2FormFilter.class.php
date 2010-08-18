<?php

/**
 * MultiArticles2 filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMultiArticles2FormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'multi_id'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dummy'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'product_ids'     => new sfWidgetFormFilterInput(),
      'aantal'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'multi_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'product_ids'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'aantal'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('multi_articles2_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MultiArticles2';
  }

  public function getFields()
  {
    return array(
      'multi_productid' => 'Number',
      'multi_id'        => 'Number',
      'dummy'           => 'Date',
      'product_ids'     => 'Number',
      'aantal'          => 'Number',
    );
  }
}
