<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * MultiArticles2 filter form base class.
 *
 * @package    filters
 * @subpackage MultiArticles2 *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseMultiArticles2FormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'multi_id'        => new sfWidgetFormFilterInput(),
      'dummy'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'product_ids'     => new sfWidgetFormFilterInput(),
      'aantal'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'multi_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'product_ids'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'aantal'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('multi_articles2_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

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