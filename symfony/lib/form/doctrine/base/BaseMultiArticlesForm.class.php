<?php

/**
 * MultiArticles form base class.
 *
 * @method MultiArticles getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMultiArticlesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'multi_id'    => new sfWidgetFormInputHidden(),
      'dummy'       => new sfWidgetFormDateTime(),
      'product_ids' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'multi_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'multi_id', 'required' => false)),
      'dummy'       => new sfValidatorDateTime(),
      'product_ids' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('multi_articles[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MultiArticles';
  }

}
