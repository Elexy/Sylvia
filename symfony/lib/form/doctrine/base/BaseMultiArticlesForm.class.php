<?php

/**
 * MultiArticles form base class.
 *
 * @package    form
 * @subpackage multi_articles
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMultiArticlesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'multi_id'    => new sfWidgetFormInputHidden(),
      'dummy'       => new sfWidgetFormDateTime(),
      'product_ids' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'multi_id'    => new sfValidatorDoctrineChoice(array('model' => 'MultiArticles', 'column' => 'multi_id', 'required' => false)),
      'dummy'       => new sfValidatorDateTime(),
      'product_ids' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('multi_articles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MultiArticles';
  }

}