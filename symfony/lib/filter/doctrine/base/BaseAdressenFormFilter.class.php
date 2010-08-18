<?php

/**
 * Adressen filter form base class.
 *
 * @package    andrea
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAdressenFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contactid'   => new sfWidgetFormFilterInput(),
      'adrestitel'  => new sfWidgetFormFilterInput(),
      'straat'      => new sfWidgetFormFilterInput(),
      'postcode'    => new sfWidgetFormFilterInput(),
      'postbus'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'plaats'      => new sfWidgetFormFilterInput(),
      'land'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dummy'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'prive_adres' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'naam'        => new sfWidgetFormFilterInput(),
      'attn'        => new sfWidgetFormFilterInput(),
      'huisnummer'  => new sfWidgetFormFilterInput(),
      'email'       => new sfWidgetFormFilterInput(),
      'telefoon'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contactid'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'adrestitel'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'straat'      => new sfValidatorPass(array('required' => false)),
      'postcode'    => new sfValidatorPass(array('required' => false)),
      'postbus'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'plaats'      => new sfValidatorPass(array('required' => false)),
      'land'        => new sfValidatorPass(array('required' => false)),
      'dummy'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'prive_adres' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'naam'        => new sfValidatorPass(array('required' => false)),
      'attn'        => new sfValidatorPass(array('required' => false)),
      'huisnummer'  => new sfValidatorPass(array('required' => false)),
      'email'       => new sfValidatorPass(array('required' => false)),
      'telefoon'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('adressen_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adressen';
  }

  public function getFields()
  {
    return array(
      'adresid'     => 'Number',
      'contactid'   => 'Number',
      'adrestitel'  => 'Number',
      'straat'      => 'Text',
      'postcode'    => 'Text',
      'postbus'     => 'Number',
      'plaats'      => 'Text',
      'land'        => 'Text',
      'dummy'       => 'Date',
      'prive_adres' => 'Number',
      'naam'        => 'Text',
      'attn'        => 'Text',
      'huisnummer'  => 'Text',
      'email'       => 'Text',
      'telefoon'    => 'Text',
    );
  }
}
