<?php

/**
 * TextCategories form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseTextCategoriesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'text_categoryid' => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'text_categoryid' => new sfValidatorPropelChoice(array('model' => 'TextCategories', 'column' => 'text_categoryid', 'required' => false)),
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
