<?php

/**
 * BaseExtraProductInfo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $productid
 * @property integer $best_syst_id
 * @property integer $backlite_yn
 * @property integer $infrarood_yn
 * @property integer $bluetooth_yn
 * @property integer $wlan_yn
 * @property integer $gsm_gprs_yn
 * @property integer $accu_size
 * @property float $geheugen_int
 * @property float $geheugen_ext
 * @property float $gewicht
 * @property integer $processor_snelheid
 * @property integer $processor_type
 * @property float $afmetingx
 * @property float $afmetingy
 * @property float $afmetingz
 * @property float $afm_schermx
 * @property float $afm_schermy
 * @property integer $resolutiex
 * @property integer $resolutiey
 * @property integer $kleuren
 * @property string $type_aansluiting
 * @property integer $accu_type_id
 * @property integer $accu_duur
 * @property string $geheugen_slot
 * 
 * @method integer          getProductid()          Returns the current record's "productid" value
 * @method integer          getBestSystId()         Returns the current record's "best_syst_id" value
 * @method integer          getBackliteYn()         Returns the current record's "backlite_yn" value
 * @method integer          getInfraroodYn()        Returns the current record's "infrarood_yn" value
 * @method integer          getBluetoothYn()        Returns the current record's "bluetooth_yn" value
 * @method integer          getWlanYn()             Returns the current record's "wlan_yn" value
 * @method integer          getGsmGprsYn()          Returns the current record's "gsm_gprs_yn" value
 * @method integer          getAccuSize()           Returns the current record's "accu_size" value
 * @method float            getGeheugenInt()        Returns the current record's "geheugen_int" value
 * @method float            getGeheugenExt()        Returns the current record's "geheugen_ext" value
 * @method float            getGewicht()            Returns the current record's "gewicht" value
 * @method integer          getProcessorSnelheid()  Returns the current record's "processor_snelheid" value
 * @method integer          getProcessorType()      Returns the current record's "processor_type" value
 * @method float            getAfmetingx()          Returns the current record's "afmetingx" value
 * @method float            getAfmetingy()          Returns the current record's "afmetingy" value
 * @method float            getAfmetingz()          Returns the current record's "afmetingz" value
 * @method float            getAfmSchermx()         Returns the current record's "afm_schermx" value
 * @method float            getAfmSchermy()         Returns the current record's "afm_schermy" value
 * @method integer          getResolutiex()         Returns the current record's "resolutiex" value
 * @method integer          getResolutiey()         Returns the current record's "resolutiey" value
 * @method integer          getKleuren()            Returns the current record's "kleuren" value
 * @method string           getTypeAansluiting()    Returns the current record's "type_aansluiting" value
 * @method integer          getAccuTypeId()         Returns the current record's "accu_type_id" value
 * @method integer          getAccuDuur()           Returns the current record's "accu_duur" value
 * @method string           getGeheugenSlot()       Returns the current record's "geheugen_slot" value
 * @method ExtraProductInfo setProductid()          Sets the current record's "productid" value
 * @method ExtraProductInfo setBestSystId()         Sets the current record's "best_syst_id" value
 * @method ExtraProductInfo setBackliteYn()         Sets the current record's "backlite_yn" value
 * @method ExtraProductInfo setInfraroodYn()        Sets the current record's "infrarood_yn" value
 * @method ExtraProductInfo setBluetoothYn()        Sets the current record's "bluetooth_yn" value
 * @method ExtraProductInfo setWlanYn()             Sets the current record's "wlan_yn" value
 * @method ExtraProductInfo setGsmGprsYn()          Sets the current record's "gsm_gprs_yn" value
 * @method ExtraProductInfo setAccuSize()           Sets the current record's "accu_size" value
 * @method ExtraProductInfo setGeheugenInt()        Sets the current record's "geheugen_int" value
 * @method ExtraProductInfo setGeheugenExt()        Sets the current record's "geheugen_ext" value
 * @method ExtraProductInfo setGewicht()            Sets the current record's "gewicht" value
 * @method ExtraProductInfo setProcessorSnelheid()  Sets the current record's "processor_snelheid" value
 * @method ExtraProductInfo setProcessorType()      Sets the current record's "processor_type" value
 * @method ExtraProductInfo setAfmetingx()          Sets the current record's "afmetingx" value
 * @method ExtraProductInfo setAfmetingy()          Sets the current record's "afmetingy" value
 * @method ExtraProductInfo setAfmetingz()          Sets the current record's "afmetingz" value
 * @method ExtraProductInfo setAfmSchermx()         Sets the current record's "afm_schermx" value
 * @method ExtraProductInfo setAfmSchermy()         Sets the current record's "afm_schermy" value
 * @method ExtraProductInfo setResolutiex()         Sets the current record's "resolutiex" value
 * @method ExtraProductInfo setResolutiey()         Sets the current record's "resolutiey" value
 * @method ExtraProductInfo setKleuren()            Sets the current record's "kleuren" value
 * @method ExtraProductInfo setTypeAansluiting()    Sets the current record's "type_aansluiting" value
 * @method ExtraProductInfo setAccuTypeId()         Sets the current record's "accu_type_id" value
 * @method ExtraProductInfo setAccuDuur()           Sets the current record's "accu_duur" value
 * @method ExtraProductInfo setGeheugenSlot()       Sets the current record's "geheugen_slot" value
 * 
 * @package    andrea
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseExtraProductInfo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('extra_product_info');
        $this->hasColumn('productid', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('best_syst_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => 1,
             'default' => '0',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('backlite_yn', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('infrarood_yn', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('bluetooth_yn', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('wlan_yn', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('gsm_gprs_yn', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 1,
             ));
        $this->hasColumn('accu_size', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => 1,
             'length' => 2,
             ));
        $this->hasColumn('geheugen_int', 'float', 6, array(
             'type' => 'float',
             'unsigned' => 1,
             'length' => 6,
             ));
        $this->hasColumn('geheugen_ext', 'float', 6, array(
             'type' => 'float',
             'unsigned' => 1,
             'length' => 6,
             ));
        $this->hasColumn('gewicht', 'float', 6, array(
             'type' => 'float',
             'unsigned' => 1,
             'default' => '0',
             'length' => 6,
             ));
        $this->hasColumn('processor_snelheid', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('processor_type', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('afmetingx', 'float', 6, array(
             'type' => 'float',
             'length' => 6,
             ));
        $this->hasColumn('afmetingy', 'float', 6, array(
             'type' => 'float',
             'length' => 6,
             ));
        $this->hasColumn('afmetingz', 'float', 6, array(
             'type' => 'float',
             'length' => 6,
             ));
        $this->hasColumn('afm_schermx', 'float', 6, array(
             'type' => 'float',
             'length' => 6,
             ));
        $this->hasColumn('afm_schermy', 'float', 6, array(
             'type' => 'float',
             'length' => 6,
             ));
        $this->hasColumn('resolutiex', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('resolutiey', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('kleuren', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('type_aansluiting', 'string', 6, array(
             'type' => 'string',
             'length' => 6,
             ));
        $this->hasColumn('accu_type_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('accu_duur', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('geheugen_slot', 'string', 6, array(
             'type' => 'string',
             'length' => 6,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}