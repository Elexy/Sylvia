<?php

/**
 * MultiArticles2 form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseMultiArticles2Form extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'multi_productid' => new sfWidgetFormInputHidden(),
      'multi_id'        => new sfWidgetFormInputText(),
      'product_ids'     => new sfWidgetFormInputText(),
      'aantal'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'multi_productid' => new sfValidatorPropelChoice(array('model' => 'MultiArticles2', 'column' => 'multi_productid', 'required' => false)),
      'multi_id'        => new sfValidatorInteger(),
      'product_ids'     => new sfValidatorInteger(array('required' => false)),
      'aantal'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'MultiArticles2', 'column' => array('multi_productid')))
    );

    $this->widgetSchema->setNameFormat('multi_articles2[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MultiArticles2';
  }


}
