<?php

/**
 * MultiArticles form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseMultiArticlesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'multi_id'    => new sfWidgetFormInputHidden(),
      'product_ids' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'multi_id'    => new sfValidatorPropelChoice(array('model' => 'MultiArticles', 'column' => 'multi_id', 'required' => false)),
      'product_ids' => new sfValidatorString(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'MultiArticles', 'column' => array('multi_id')))
    );

    $this->widgetSchema->setNameFormat('multi_articles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MultiArticles';
  }


}
