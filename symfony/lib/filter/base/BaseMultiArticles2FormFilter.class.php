<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * MultiArticles2 filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseMultiArticles2FormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'multi_id'        => new sfWidgetFormFilterInput(),
      'product_ids'     => new sfWidgetFormFilterInput(),
      'aantal'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'multi_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'product_ids'     => 'Number',
      'aantal'          => 'Number',
    );
  }
}
