<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Personen filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BasePersonenFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'        => new sfWidgetFormFilterInput(),
      'personen_type_id' => new sfWidgetFormFilterInput(),
      'titel'            => new sfWidgetFormFilterInput(),
      'voornaam'         => new sfWidgetFormFilterInput(),
      'achternaam'       => new sfWidgetFormFilterInput(),
      'tussenvoegsel'    => new sfWidgetFormFilterInput(),
      'languageid'       => new sfWidgetFormFilterInput(),
      'email'            => new sfWidgetFormFilterInput(),
      'mailing_yn'       => new sfWidgetFormFilterInput(),
      'tel'              => new sfWidgetFormFilterInput(),
      'fax'              => new sfWidgetFormFilterInput(),
      'aanhef'           => new sfWidgetFormFilterInput(),
      'gender'           => new sfWidgetFormFilterInput(),
      'notes'            => new sfWidgetFormFilterInput(),
      'mobile'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'personen_type_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'titel'            => new sfValidatorPass(array('required' => false)),
      'voornaam'         => new sfValidatorPass(array('required' => false)),
      'achternaam'       => new sfValidatorPass(array('required' => false)),
      'tussenvoegsel'    => new sfValidatorPass(array('required' => false)),
      'languageid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email'            => new sfValidatorPass(array('required' => false)),
      'mailing_yn'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tel'              => new sfValidatorPass(array('required' => false)),
      'fax'              => new sfValidatorPass(array('required' => false)),
      'aanhef'           => new sfValidatorPass(array('required' => false)),
      'gender'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notes'            => new sfValidatorPass(array('required' => false)),
      'mobile'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('personen_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Personen';
  }

  public function getFields()
  {
    return array(
      'persoonid'        => 'Number',
      'contactid'        => 'Number',
      'personen_type_id' => 'Number',
      'titel'            => 'Text',
      'voornaam'         => 'Text',
      'achternaam'       => 'Text',
      'tussenvoegsel'    => 'Text',
      'languageid'       => 'Number',
      'email'            => 'Text',
      'mailing_yn'       => 'Number',
      'tel'              => 'Text',
      'fax'              => 'Text',
      'aanhef'           => 'Text',
      'gender'           => 'Number',
      'notes'            => 'Text',
      'mobile'           => 'Text',
    );
  }
}
