<?php

namespace app\modules\admin\Parser\models;

use Yii;
use yii\base\Model;

class Paths extends Model {
    /*
     * Класс для описания всех путей до данных в xml-файле.
     * Должен применяться в Parser.php для получения путей к данным
     * ! Черновой нерабочий вариант !
     */
    public static $path_to_ПланыКомпетенции = 'children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->ПланыКомпетенции';
}
