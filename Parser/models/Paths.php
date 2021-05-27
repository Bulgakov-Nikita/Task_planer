<?php

namespace app\modules\admin\Parser\models;

class Paths {
    /*
     * Класс для описания всех путей до данных в xml-файле.
     * Должен применяться в Parser.php для получения путей к данным
     */
    public static $path_to_ПланыКомпетенции = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->ПланыКомпетенции;';
    public static $path_to_Планы = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->Планы;';
    public static $path_to_Филиалы = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->Филиалы;';
    public static $path_to_Факультеты = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->Факультеты;';
    public static $path_to_ВидыДеятельности = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->ВидыДеятельности;';
    public static $path_to_ФормаОбучения = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->ФормаОбучения;';
    public static $path_to_СправочникВидыРабот = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->СправочникВидыРабот;';
    public static $path_to_ПланыГрафикиЯчейки = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->ПланыГрафикиЯчейки;';
    public static $path_to_ДолжностныеЛица = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->ДолжностныеЛица;';
    public static $path_to_псСтандарты = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->псСтандарты;';
    public static $path_to_псОбобщенныеФункции = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->псОбобщенныеФункции;';
    public static $path_to_псФункции = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->псФункции;';
    public static $path_to_псГруппы = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->псГруппы;';


}
