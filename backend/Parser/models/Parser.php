<?php

namespace app\modules\admin\Parser\models;

use Yii;
use yii\base\Model;
use app\modules\admin\Parser\models\Paths;

class Parser extends Model {
    public $file;
    public $results = []; // сюда должны будут сохраняться результаты парсинга, скорее всего это будет двумерный ассоциативный массив


    public function parse() {
        /* Пример работы функции parse(). Она получает введёный пользователем файл и
         * парсит его, выводя коды планов компетенции. В будующем все данные должны записываться
         * в БД
         */
        $data = file_get_contents($this->file->tempName);
        $xml = new \SimpleXMLElement($data);
        $path = $xml->children("urn:schemas-microsoft-com:xml-diffgram-v1")->children()->dsMMISDB->ПланыКомпетенции;

        echo 'Коды всех планов компетенции: ';
        foreach ($path as $p) {
            echo ' ' . $p['Код'];
        }
    }

    public function save_data() {

    }
}
