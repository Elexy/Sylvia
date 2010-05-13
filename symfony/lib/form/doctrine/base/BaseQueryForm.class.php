<?php

/**
 * Query form base class.
 *
 * @package    form
 * @subpackage query
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseQueryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'      => new sfWidgetFormInputText(),
      'id'        => new sfWidgetFormInputHidden(),
      'statement' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'name'      => new sfValidatorString(array('max_length' => 35)),
      'id'        => new sfValidatorDoctrineChoice(array('model' => 'Query', 'column' => 'id', 'required' => false)),
      'statement' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
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