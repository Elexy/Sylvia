<?php

/**
 * Personen filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePersonenFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'personen_type_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'languageid'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mailing_yn'       => new sfWidgetFormFilterInput(),
      'gender'           => new sfWidgetFormFilterInput(),
      'dummy'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'titel'            => new sfWidgetFormFilterInput(),
      'voornaam'         => new sfWidgetFormFilterInput(),
      'achternaam'       => new sfWidgetFormFilterInput(),
      'tussenvoegsel'    => new sfWidgetFormFilterInput(),
      'email'            => new sfWidgetFormFilterInput(),
      'tel'              => new sfWidgetFormFilterInput(),
      'fax'              => new sfWidgetFormFilterInput(),
      'aanhef'           => new sfWidgetFormFilterInput(),
      'notes'            => new sfWidgetFormFilterInput(),
      'mobile'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'personen_type_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'languageid'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mailing_yn'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gender'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'dummy'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'titel'            => new sfValidatorPass(array('required' => false)),
      'voornaam'         => new sfValidatorPass(array('required' => false)),
      'achternaam'       => new sfValidatorPass(array('required' => false)),
      'tussenvoegsel'    => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
      'tel'              => new sfValidatorPass(array('required' => false)),
      'fax'              => new sfValidatorPass(array('required' => false)),
      'aanhef'           => new sfValidatorPass(array('required' => false)),
      'notes'            => new sfValidatorPass(array('required' => false)),
      'mobile'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('personen_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

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
      'languageid'       => 'Number',
      'mailing_yn'       => 'Number',
      'gender'           => 'Number',
      'dummy'            => 'Date',
      'titel'            => 'Text',
      'voornaam'         => 'Text',
      'achternaam'       => 'Text',
      'tussenvoegsel'    => 'Text',
      'email'            => 'Text',
      'tel'              => 'Text',
      'fax'              => 'Text',
      'aanhef'           => 'Text',
      'notes'            => 'Text',
      'mobile'           => 'Text',
    );
  }
}
