<?php

/**
 * MultiArticles2 form base class.
 *
 * @method MultiArticles2 getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMultiArticles2Form extends BaseFormDoctrine
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
      'multi_productid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'multi_productid', 'required' => false)),
      'multi_id'        => new sfValidatorInteger(array('required' => false)),
      'dummy'           => new sfValidatorDateTime(),
      'product_ids'     => new sfValidatorInteger(array('required' => false)),
      'aantal'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('multi_articles2[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MultiArticles2';
  }

}
