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
           // $table->main_plan_id = 1; // временно, потом исправить

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

        $god = (string)$path['СрокОбучения'];
        $masec = (string)$path['СрокОбученияМесяцев'];
        if (tables\SrocEducation::find()->andWhere(['god' => $god])->count() == 1 and
            tables\SrocEducation::find()->andWhere(['masec' => $masec])->count() == 1) {
            return;
        }
        $table->god = $god;
        $table->masec = $masec;

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

    private function parse_type_session_table() {
        $path = eval(Paths::$path_to_Заезды);

        foreach ($path as $p){
            $table = new tables\TypeSession();

            $name = (string) $p['Название'];
            if (tables\TypeSession::find()->andWhere(['name' => $name])->count() == 1){ continue; }
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

    private function parse_session_table() {
        $path = eval(Paths::$path_to_Заезды);

        foreach ($path as $p){
            $table = new tables\TypeSession();

            $name = (string) $p['Название'];
            if (tables\TypeSession::find()->andWhere(['name' => $name])->count() == 1){
                continue;
            }
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

    private function parse_form_table() {
        $path = eval(Paths::$path_to_Заезды);

        foreach ($path as $p){
            $table = new tables\Form();

            $data = (string) $p['Название'];
            if (tables\Form::find()->andWhere(['name' => $data])->count() == 1){
                continue;
            }
            $table->data = $data;

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

    private function parse_sprav_kafedra_table() {
        $path = eval(Paths::$path_to_Кафедры);
        $path1 = eval(Paths::$path_to_Факультеты);

        foreach ($path as $p) {
            $table = new tables\SpravKafedra();

            $name = (string)$p['Название'];


            if (tables\SpravKafedra::find()->andWhere(['name' => $name])->count() == 1) {
                continue;
            }
            $table->name = $name;
            foreach ($path1 as $p1) {
                $facultet = (string) $p1['Факультет'];
                $facultet_id = (tables\SpravFacultet::findOne(['name' => $facultet]))->id;
                if (tables\SpravKafedra::find()->andWhere(['name' => $name, 'sprav_facultet_id' => $facultet_id])->count() == 1) {
                    continue;
                }
                $table->sprav_facultet_id = $facultet_id;

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
    }

    private function parse_sprav_dis_table(){
        $path = eval(Paths::$path_to_ПланыСтроки);
        $path1 = eval(Paths::$path_to_Кафедры);

        foreach ($path as $p) {
            $table = new tables\SpravDis();

            $name = (string)$p['Дисциплина'];


            if (tables\SpravDis::find()->andWhere(['name' => $name])->count() == 1) {
                continue;
            }
            $table->name = $name;
            foreach ($path1 as $p1) {
                $kafedra = (string) $p1['Название'];
                $kafedra_id = (tables\SpravKafedra::findOne(['name' => $kafedra]))->id;
                if (tables\SpravDis::find()->andWhere(['name' => $name, 'sprav_kafedra_id' => $kafedra_id])->count() == 1) {
                    continue;
                }
                $table->sprav_kafedra_id = $kafedra_id;

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
    }

    private function parse_disciplins_table(){
        $path = eval(Paths::$path_to_ПланыСтроки);
        $path1 = eval(Paths::$path_to_Кафедры);
        $path2 = eval(Paths::$path_to_ПланыСтроки);

        foreach ($path as $p) {
            $table = new tables\Diciplins();
            $index = (string)$p['ДисциплинаКод'];

            if (tables\SpravDis::find()->andWhere(['index' => $index])->count() == 1) {
                continue;
            }
            $table->index = $index;

            foreach ($path1 as $p1) {
                $kafedra = (string) $p1['Название'];

                $kafedra_id = (tables\Kafedra::findOne(['name' => $kafedra]))->id;
            if (tables\SpravDis::find()->andWhere(['kafedra_id' => $kafedra_id])->count() == 1) {
                continue;
            }
            $table->kafedra_id = $kafedra_id;

                foreach ($path2 as $p2){
                    $sprav_dis = (string) $p2['Дисциплина'];

                    $sprav_dis_id = (tables\Kafedra::findOne(['name' => $sprav_dis]))->id;
                    if (tables\SpravDis::find()->andWhere(['index' => $index, 'kafedra_id' => $kafedra_id, 'sprav_dis_id' => $sprav_dis_id])->count() == 1) {
                        continue;
                    }
                    $table->sprav_dis_id = $sprav_dis_id;

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
        }
    }

    private function parse_kaf_has_comp_table() {
        $path = eval(Paths::$path_to_ПланыКомпетенции);
        $path1 = eval(Paths::$path_to_Кафедры);

        foreach ($path as $p) {
            $table = new tables\KafHasComp();

            $comp = (string) $p['Наименование'];
            $comp_id = (tables\Kafedra::findOne(['index' => $comp]))->id;

            $table->comp_id = $comp_id;
            foreach ($path1 as $p1) {
                $kafedra = (string) $p1['ШифрКомпетенции'];
                $kafedra_id = (tables\Comp::findOne(['name' => $kafedra]))->id;
                if (tables\KafHasComp::find()->andWhere(['comp_id' => $comp_id, 'kafedra_id' => $kafedra_id])->count() == 1) {
                    continue;
                }
                $table->kafedra_id = $kafedra_id;

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
    }
    private function parse_type_form_table(){
        $path = eval(Paths::$path_to_СправочникТипОбъекта);

        foreach ($path as $p) {
            $table = new tables\TypeForm();

            $name = (string) $p['Название'];
            if (tables\TypeForm::find()->andWhere(['name' => $name])->count() == 1) {
                continue;
            }
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
    private function parse_sprav_uch_god_table(){
        $path = eval(Paths::$path_to_ООП);

        foreach ($path as $p) {
            $table = new tables\SpravUchGod();

            $name = (string) $p['Название'];
            if (tables\SpravUchGod::find()->andWhere(['name' => $name])->count() == 1) {
                continue;
            }
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
    public function parse_dc_table(){
        $path = eval(Paths::$path_to_ПланыСтроки);
        $path1 = eval(Paths::$path_to_ПланыКомпетенции);

        foreach ($path as $p) {
            $table = new tables\Dc();

            $disciplins = (string) $p['ДисциплинаКод'];
            $disciplins_id = (tables\Disciplins::findOne(['index' => $disciplins]))->id;
            
            $table->disciplins_id = $disciplins_id;
            foreach ($path1 as $p1){
                $table = new tables\Dc();

                $comp = (string) $p['ШифрКомпетенции'];
                $comp_id = (tables\Comp::findOne(['index' => $comp]))->id;

                if (tables\Dc::find()->andWhere(['disciplins_id' => $disciplins_id, 'comp_id' => $comp_id])->count() == 1) {
                    continue;
                }

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
    }

    private function parse_np_table() {
    }

    private function parse_main_plan_table() {
    }

    private function parse_plan_table() {
    }

    private function parse_podpisants_table() {
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
        // $this->parse_institut_table();
        // $this->parse_sprav_facultet_table();
        // $this->parse_type_task_pd_table();
        // $this->parse_kvalification_table();
        // $this->parse_fo_table();
        // $this->parse_type_work_table();
        // $this->parse_type_periods_table();
    //    $this->parse_staff_table(); // Александр. Переделать, FIO теперь разделено на 3 атрибута
        // $this->parse_prof_standart_table(); // Никита
        // $this->parse_comp_ps_table(); // Никита
        // $this->parse_sroc_education_table(); // Александр
        // $this->parse_type_session_table(); // Александр
        // $this->parse_session_table();
        // $this->parse_form_table(); // Александр
        // $this->parse_sprav_kafedra_table(); // Александр
        // $this->parse_sprav_dis_table(); // Александр
        // $this->parse_disciplins_table(); // Александр
        // $this->parse_kaf_has_comp_table(); // Александр
        // $this->parse_type_form_table(); // Александр
        // $this->parse_sprav_uch_god_table(); //Александр
        // $this->parse_dc_table(); //Александр
        // в процессе
        
        // не готово
//        $this->parse_np_table(); // Никита
//        $this->parse_sprav_table(); // Александр
//        $this->parse_podpisants_table();
//        $this->parse_comp_table(); // добавить main_plan_id FK
//        $this->parse_main_plan_table();
//        $this->parse_plan_table();

        //под вопросом
//        $this->parse_type_periods_table();


        $this->save_all($transaction);
    }
}