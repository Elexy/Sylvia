<?php

/**
 * TextCategories form base class.
 *
 * @package    form
 * @subpackage text_categories
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseTextCategoriesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'text_categoryid' => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'text_categoryid' => new sfValidatorDoctrineChoice(array('model' => 'TextCategories', 'column' => 'text_categoryid', 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('text_categories[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TextCategories';
  }

}