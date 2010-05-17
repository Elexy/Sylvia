<?php

/**
 * RmaSubject form base class.
 *
 * @package    form
 * @subpackage rma_subject
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseRmaSubjectForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'subject_id'   => new sfWidgetFormInputHidden(),
      'subject_text' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'subject_id'   => new sfValidatorDoctrineChoice(array('model' => 'RmaSubject', 'column' => 'subject_id', 'required' => false)),
      'subject_text' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_subject[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RmaSubject';
  }

}