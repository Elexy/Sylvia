<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * MultiArticles filter form base class.
 *
 * @package    filters
 * @subpackage MultiArticles *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseMultiArticlesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dummy'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'product_ids' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'dummy'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'product_ids' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('multi_articles_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MultiArticles';
  }

  public function getFields()
  {
    return array(
      'multi_id'    => 'Number',
      'dummy'       => 'Date',
      'product_ids' => 'Text',
    );
  }
}