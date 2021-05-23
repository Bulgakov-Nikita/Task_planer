<?php

namespace app\modules\admin\Parser\models;

class Paths {
    /*
     * Класс для описания всех путей до данных в xml-файле.
     * Должен применяться в Parser.php для получения путей к данным
     */
    public static $path_to_ПланыКомпетенции = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->ПланыКомпетенции;';
    public static $path_to_Планы = 'return $this->xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->Планы;';
}
