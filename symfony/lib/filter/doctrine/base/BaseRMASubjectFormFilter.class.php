<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * RMASubject filter form base class.
 *
 * @package    filters
 * @subpackage RMASubject *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseRMASubjectFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'subject_text' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'subject_text' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_subject_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RMASubject';
  }

  public function getFields()
  {
    return array(
      'subject_id'   => 'Number',
      'subject_text' => 'Text',
    );
  }
}