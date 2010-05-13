<?php

/**
 * MultiArticles2 form base class.
 *
 * @package    form
 * @subpackage multi_articles2
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseMultiArticles2Form extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'multi_productid' => new sfWidgetFormInputHidden(),
      'multi_id'        => new sfWidgetFormInputText(),
      'dummy'           => new sfWidgetFormDateTime(),
      'product_ids'     => new sfWidgetFormInputText(),
      'aantal'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'multi_productid' => new sfValidatorDoctrineChoice(array('model' => 'MultiArticles2', 'column' => 'multi_productid', 'required' => false)),
      'multi_id'        => new sfValidatorInteger(),
      'dummy'           => new sfValidatorDateTime(),
      'product_ids'     => new sfValidatorInteger(array('required' => false)),
      'aantal'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('multi_articles2[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MultiArticles2';
  }

}