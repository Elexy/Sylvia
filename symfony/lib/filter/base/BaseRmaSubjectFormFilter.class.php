<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * RmaSubject filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseRmaSubjectFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'subject_id'   => new sfWidgetFormFilterInput(),
      'subject_text' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'subject_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'subject_text' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rma_subject_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RmaSubject';
  }

  public function getFields()
  {
    return array(
      'subject_id'   => 'Number',
      'subject_text' => 'Text',
      'id'           => 'Number',
    );
  }
}
