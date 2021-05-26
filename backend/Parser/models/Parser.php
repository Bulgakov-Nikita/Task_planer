<?php

namespace app\modules\admin\Parser\models;

use app\modules\admin\Parser\models\tables\TypeTaskPd;
use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;

class Parser extends Model {
    public $file;
    private $xml;
    private $not_parse_errors = true;

    private function parse_fgos_table() {
        $table = new tables\fgos();
        $path = eval(Paths::$path_to_Планы);

        $number = (integer) $path['НомерФГОС'];
        if (tables\Fgos::find()->andWhere(['number' => $number])->count() == 1) { return; }
        $table->number = $number;
        $table->date = $path['ДатаГОСа'];
        $table->path_file = 'null';

        $table->create_at = time();
        $table->create_by = Yii::$app->user->getId();
        $table->update_at = time();
        $table->update_by = Yii::$app->user->getId();
        $table->active = 1;
        $table->lock = 1;

        if (!$table->save()) {
            $this->not_parse_errors = false;
        }
    }

    private function parse_comp_table() {
        $path = eval(Paths::$path_to_ПланыКомпетенции);

        foreach ($path as $p) {
            $table = new tables\Comp();

            $index = (integer) $p['ШифрКомпетенции'];
            if (tables\Comp::find()->andWhere(['index' => $index])->count() == 1) { continue; }
            $table->index = $index;
            $table->soderzhanie = $p['Наименование'];

            $table->create_at = time();
            $table->create_by = Yii::$app->user->getId();
            $table->update_at = time();
            $table->update_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
    }

    private function parse_institut_table() {
        $path = eval(Paths::$path_to_Филиалы);

        foreach ($path as $p) {
            $table = new tables\Institut();

            $table->name = $p['Полное_название'];
            $table->code_filiala = $p['Код_филиала'];

            $table->create_at = time();
            $table->create_by = Yii::$app->user->getId();
            $table->update_at = time();
            $table->update_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
    }

    private function parse_type_task_pd_table() {
        $path = eval(Paths::$path_to_ВидыДеятельности);

        foreach ($path as $p) {
            $table = new tables\TypeTaskPd();

            $name = (string) $p['Наименование'];
            if (TypeTaskPd::find()->andWhere(['name' => $name])->count() == 1) { continue; }
            $table->name = $name;

            $table->create_at = time();
            $table->create_by = Yii::$app->user->getId();
            $table->update_at = time();
            $table->update_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
    }

    private function parse_np_table() {
    }

    private function parse_facultet_table() {
        $path = eval(Paths::$path_to_Факультеты);

        foreach ($path as $p) {
            $table = new tables\Facultet();

            $name = (string) $p['Факультет'];
            $filial_code = (int) $p['Код_филиала'];
            $institut_id = (tables\Institut::findOne(['code_filiala' => $filial_code]))->id;

            // проверка уникальности
            if (tables\Facultet::findOne(['name' => $name, 'institut_id' => $institut_id])) { continue; }

            $table->name = $name;
            $table->institut_id = $institut_id;

            $table->create_at = time();
            $table->create_by = Yii::$app->user->getId();
            $table->update_at = time();
            $table->update_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
    }

    private function parse_comp2_table() {
    }

    private function parse_fo_table() {
    }

    private function parse_form_table() {
    }

    private function parse_kafedra_table() {
    }

    private function parse_kk_table() {
    }

    private function parse_kvalification_table() {
    }

    private function parse_main_plan_table() {
    }

    private function parse_plan_table() {
    }

    private function parse_podpisants_table() {
    }

    private function parse_prof_standart_table() {
    }

    private function parse_session_table() {
    }

    private function parse_sroc_education_table() {
    }

    private function parse_staff_table() {
    }

    private function parse_type_periods_table() {
    }

    private function parse_type_session_table() {
    }

    private function parse_type_work_table() {
    }

    private function save_all($transaction) {
        /* Если ошибок при записи данных не было,
         * то изменения сохраняются, иначе откатываются
         */
        if ($this->not_parse_errors) {
            $transaction->commit();
        } else {
            $transaction->rollback();
        }
    }

    public function parse() {
        /* Функция получает файл пользователя и парсит его,
         * вызывая функции парсинга данных для определённых
         * таблиц
         */

        $data = file_get_contents($this->file->tempName);
        $this->xml = new \SimpleXMLElement($data);

        $transaction = Yii::$app->db->beginTransaction();

        // сделано
      // $this->parse_fgos_table();
      // $this->parse_comp_table(); // добавить main_plan_id FK
      //  $this->parse_institut_table();
      //  $this->parse_facultet_table();
      //   $this->parse_type_task_pd_table();

        // в процессе
//        $this->parse_np_table();

        // не готово
//        $this->parse_comp2_table();
//        $this->parse_fo_table();
//        $this->parse_form_table();
//        $this->parse_kafedra_table();
//        $this->parse_kk_table();
//        $this->parse_kvalification_table();
//        $this->parse_main_plan_table();
//        $this->parse_plan_table();
//        $this->parse_podpisants_table();
//        $this->parse_prof_standart_table();
//        $this->parse_session_table(]);
//        $this->parse_sroc_education_table();
//        $this->parse_staff_table(;
//        $this->parse_type_periods_table();
//        $this->parse_type_session_table();
//        $this->parse_type_work_table();

        $this->save_all($transaction);
    }
}
