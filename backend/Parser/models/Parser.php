<?php

namespace app\modules\admin\Parser\models;

use Yii;
use yii\base\Model;

class Parser extends Model{
    public $file;
    private $xml;

    private function parse_fgos_table() {
        /* Функция для заполнения таблицы fgos.
         * Используется модель Fgos.php для доступа к БД
         */

        $table = new tables\Fgos();
        $path = eval(Paths::$path_to_Планы);

        $table->number = $path['НомерФГОС'];
        $table->date = $path['ДатаГОСа'];
        $table->path_file = 'null';

        $table->create_at = 1; // для теста, потом сделать нормально
        $table->create_by = 1; // для теста, потом сделать нормально
        $table->update_at = 1; // для теста, потом сделать нормально
        $table->update_by = 1; // для теста, потом сделать нормально
        $table->delete_at = 1; // для теста, потом сделать нормально
        $table->delete_by = 1; // для теста, потом сделать нормально
        $table->active = 1; // для теста, потом сделать нормально
        $table->lock = 1; // для теста, потом сделать нормально

        $table->save(); // сохранение результатов парсинга
    }

    public function parse() {
        /* Эта функция получает файл от пользователя и запускает
         * функции парсинга таблиц для их заполнения
         */
        $data = file_get_contents($this->file->tempName);
        $this->xml = new \SimpleXMLElement($data);

        // вызов функций для парсинга (пока только одна)
        $this->parse_fgos_table();
    }
}
