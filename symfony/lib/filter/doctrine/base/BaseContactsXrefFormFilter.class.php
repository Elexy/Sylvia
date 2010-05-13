<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * ContactsXref filter form base class.
 *
 * @package    filters
 * @subpackage ContactsXref *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseContactsXrefFormFilter extends BaseFormFilterDoctrine
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