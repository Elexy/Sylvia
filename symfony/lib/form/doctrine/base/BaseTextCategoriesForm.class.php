<?php

/**
 * TextCategories form base class.
 *
 * @method TextCategories getObject() Returns the current form's model object
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTextCategoriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'text_categoryid' => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'text_categoryid' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'text_categoryid', 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('text_categories[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TextCategories';
  }

}
