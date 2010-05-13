<?php

/**
 * ContactsXref filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseContactsXrefFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid' => new sfWidgetFormFilterInput(),
      'otherid'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'otherid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('contacts_xref_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContactsXref';
  }

  public function getFields()
  {
    return array(
      'contactid' => 'Number',
      'otherid'   => 'Number',
      'id'        => 'Number',
    );
  }
}
