<?php

/**
 * Query form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseQueryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'      => new sfWidgetFormInput(),
      'statement' => new sfWidgetFormTextarea(),
      'id'        => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'name'      => new sfValidatorString(array('max_length' => 35)),
      'statement' => new sfValidatorString(array('required' => false)),
      'id'        => new sfValidatorPropelChoice(array('model' => 'Query', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('query[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Query';
  }


}
