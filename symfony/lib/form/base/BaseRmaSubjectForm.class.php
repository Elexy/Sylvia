<?php

/**
 * RmaSubject form base class.
 *
 * @package    andrea
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseRmaSubjectForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'subject_id'   => new sfWidgetFormInput(),
      'subject_text' => new sfWidgetFormInput(),
      'id'           => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'subject_id'   => new sfValidatorInteger(),
      'subject_text' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'id'           => new sfValidatorPropelChoice(array('model' => 'RmaSubject', 'column' => 'id', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'RmaSubject', 'column' => array('subject_id')))
    );

    $this->widgetSchema->setNameFormat('rma_subject[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RmaSubject';
  }


}
