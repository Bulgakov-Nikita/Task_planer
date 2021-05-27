<?php

namespace app\modules\admin\Parser\models;

use Yii;
use yii\base\Model;

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
            if (tables\TypeTaskPd::find()->andWhere(['name' => $name])->count() == 1) { continue; }
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

    private function parse_sprav_facultet_table() {
        $path = eval(Paths::$path_to_Факультеты);

        foreach ($path as $p) {
            $table = new tables\SpravFacultet();

            $name = (string) $p['Факультет'];
            $filial_code = (int) $p['Код_филиала'];
            $institut_id = (tables\Institut::findOne(['code_filiala' => $filial_code]))->id;

            // проверка уникальности
            if (tables\SpravFacultet::findOne(['name' => $name, 'institut_id' => $institut_id])) { continue; }

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

    private function parse_kvalification_table() {
        $path = eval(Paths::$path_to_Планы);
        $table = new tables\Kvalification();

        $name = (string) $path['Квалификация'];
        if (tables\Kvalification::find()->andWhere(['name' => $name])->count() == 1) { return; }
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

    private function parse_fo_table() {
        $path = eval(Paths::$path_to_ФормаОбучения);

        foreach ($path as $p){
            $table = new tables\Fo();

            $name = (string) $p['ФормаОбучения'];
            if (tables\Fo::find()->andWhere(['name' => $name])->count() == 1) { continue; }
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

    private function parse_type_work_table() {
        $path = eval(Paths::$path_to_СправочникВидыРабот);

        foreach ($path as $p){
            $table = new tables\TypeWork();

            $name = (string) $p['Название'];
            if (tables\TypeWork::find()->andWhere(['name' => $name])->count() == 1) { continue; }
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

    private function parse_type_periods_table() {
        $path = eval(Paths::$path_to_ПланыГрафикиЯчейки);

        foreach ($path as $p){
            $table = new tables\TypePeriods();

            $name = (string) $p['КодВидаДеятельности'];
            if (tables\TypePeriods::find()->andWhere(['name' => $name])->count() == 1) { continue; }
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

    private function parse_staff_table() {
        $path = eval(Paths::$path_to_ДолжностныеЛица);

        foreach ($path as $p){
            $table = new tables\Staff();

            $FIO = (string) $p['ФИО'];
            $post = (string) $p['Должность'];
            if (tables\Staff::find()->andWhere(['FIO' => $FIO])->count() == 1 and
                tables\Staff::find()->andWhere(['post' => $post])->count() == 1) { continue; }
            $table->FIO = $FIO;
            $table->post = $post;

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

    private function parse_sroc_education_table() {
        $path = eval(Paths::$path_to_Планы);
        $table = new tables\SrocEducation();

        $name = (string) $path['СрокОбучения'];
        if (tables\SrocEducation::find()->andWhere(['name' => $name])->count() == 1) { return; }
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

    private function parse_prof_standart_table() {
        $path = eval(Paths::$path_to_псСтандарты);
        if ($path['ПриказДата'] == null) { return; }
        $table = new tables\ProfStandart;

        $number = (string) $path['НомерВГруппе'];
        if (tables\ProfStandart::find()->andWhere(['number' => $number])->count() == 1) { return; }
        $table->number = $number;
        $table->date = $path['ПриказДата'];

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

    private function parse_comp_ps_table() {
        $path = eval(Paths::$path_to_псГруппы);
        if ($path['Группа'] == null) { return; }

        $standart = eval(Paths::$path_to_псСтандарты);
        $standart_number = (string) $standart['НомерВГруппе'];
        $standart_id = (tables\ProfStandart::findOne(['number' => $standart_number]))->id;

        $path = eval(Paths::$path_to_псГруппы);
        $table = new tables\CompPs();
        $index = (string) $path['КодГруппы'];
        $name = (string) $path['Группа'];
        if (tables\CompPs::find()->andWhere(['name' => $name, 'index' => $index])->count() == 0) {
            $table->index = $index;
            $table->name = $name;
            $table->prof_standart_id = $standart_id;

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

        $path = eval(Paths::$path_to_псСтандарты);
        $table = new tables\CompPs();
        $index = (string) $path['НомерВГруппе'];
        $name = (string) $path['НаименованиеСтандарта'];
        if (tables\CompPs::find()->andWhere(['name' => $name, 'index' => $index])->count() == 0) {
            $table->index = $index;
            $table->name = $name;
            $table->prof_standart_id = $standart_id;

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

        $path = eval(Paths::$path_to_псОбобщенныеФункции);
        foreach ($path as $p) {
            $table = new tables\CompPs();

            $name = (string) $p['ОбобщеннаяФункция'];
            $index = (string) $p['Шифр'];
            if (tables\CompPs::find()->andWhere(['name' => $name, 'index' => $index])->count() == 1) { continue; }
            $table->name = $name;
            $table->index = $index;
            $table->trebovanie = $p['ТребованияОбразование'];
            $table->prof_standart_id = $standart_id;

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

        $path = eval(Paths::$path_to_псФункции);
        foreach ($path as $p) {
            $table = new tables\CompPs();

            $name = (string) $p['Функция'];
            $index = (string) $p['Шифр'];
            if (tables\CompPs::find()->andWhere(['name' => $name, 'index' => $index])->count() == 1) { continue; }
            $table->name = $name;
            $table->index = $index;
            $table->prof_standart_id = $standart_id;

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

    private function parse_form_table() {
    }

    private function parse_kafedra_table() {
    }

    private function parse_kk_table() {
    }

    private function parse_main_plan_table() {
    }

    private function parse_plan_table() {
    }

    private function parse_podpisants_table() {
    }

    private function parse_session_table() {
    }

    private function parse_type_session_table() {
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
    //   $this->parse_fgos_table();
        //   $this->parse_institut_table();
        //   $this->parse_sprav_facultet_table();
        //   $this->parse_type_task_pd_table();
        //   $this->parse_kvalification_table();
        //   $this->parse_fo_table();
        //   $this->parse_type_work_table();
        //   $this->parse_staff_table();

        //   $this->parse_prof_standart_table(); // Никита
        //   $this->parse_comp_ps_table(); // Никита

        //   $this->parse_sroc_education_table(); // Александр

        // в процессе
//        $this->parse_np_table(); // Никита
//        $this->parse_session_table(]); // Элвин

        // не готово
//        $this->parse_kafedra_table(); // Никита
//        $this->parse_comp_table(); // Никита // добавить main_plan_id FK
//        $this->parse_kaf_has_table(); // Никита
//        $this->parse_form_table(); // Александр
//        $this->parse_disciplins_table(); // Александр
//        $this->parse_sprav_table(); // Александр
//        $this->parse_type_form_table(); // Александр
//        $this->parse_podpisants_table();
//        $this->parse_main_plan_table();
//        $this->parse_plan_table();

        //под вопросом
//        $this->parse_type_periods_table();


        $this->save_all($transaction);
    }
}