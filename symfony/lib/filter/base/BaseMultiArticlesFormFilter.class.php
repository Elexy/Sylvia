<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * MultiArticles filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseMultiArticlesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_ids' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
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
      'product_ids' => 'Text',
    );
  }
}
