<?php

/**
 * MultiArticles filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMultiArticlesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'dummy'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'product_ids' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'dummy'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'product_ids' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('multi_articles_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
