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

        $table->created_at = time();
        $table->created_by = Yii::$app->user->getId();
        $table->updated_at = time();
        $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

        $table->created_at = time();
        $table->created_by = Yii::$app->user->getId();
        $table->updated_at = time();
        $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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
            $F = explode(" ", $FIO);
            $I = explode (".", $F[1]);
            $O = explode (".", $F[1]);

            $post = (string) $p['Должность'];
            if (tables\Staff::find()->andWhere(['F' => $F[0]])->count() == 1 and
                tables\Staff::find()->andWhere(['I' => $I[0]])->count() == 1 and
                tables\Staff::find()->andWhere(['O' => $O[1]])->count() == 1 and
                tables\Staff::find()->andWhere(['post' => $post])->count() == 1) { continue; }
            $table->F = $F[0];
            $table->I = $I[0];
            $table->O = $O[1];
            $table->OO = 'NULL';
            $table->post = $post;

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

        $god = (string) $path['СрокОбучения'];
        $mesec = (string) $path['СрокОбученияМесяцев'];
        $name = $god.'г '.$mesec.'м';
        if (tables\SrocEducation::find()->andWhere(['name' => $name])->count() == 1) {
            return;
        }
        $table->name = $name;

        $table->created_at = time();
        $table->created_by = Yii::$app->user->getId();
        $table->updated_at = time();
        $table->updated_by = Yii::$app->user->getId();
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

        $table->created_at = time();
        $table->created_by = Yii::$app->user->getId();
        $table->updated_at = time();
        $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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
            $table = new tables\Session();

            $data = (string) $p['Название'];
            if (tables\Session::find()->andWhere(['data' => $data])->count() == 1){
                continue;
            }
            $table->data = $data;

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
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

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
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

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
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

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
    }

    private function parse_disciplins_table(){
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
                if (tables\SpravDis::find()->andWhere(['name' => $name, 'kafedra_id' => $kafedra_id])->count() == 1) {
                    continue;
                }
                $table->kafedra_id = $kafedra_id;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;

                if (!$table->save()) {
                    $this->not_parse_errors = false;
                }
            }
        }
    }

    private function parse_kaf_has_comp_table() {
        $path = eval(Paths::$path_to_ПланыСтроки);
        $path1 = eval(Paths::$path_to_ПланыСтроки);

        foreach ($path as $p) {
            $table = new tables\SpravDis();

            $name = (string)$p['Дисциплина'];


            if (tables\SpravDis::find()->andWhere(['name' => $name])->count() == 1) {
                continue;
            }
            $table->name = $name;
            foreach ($path1 as $p1) {
                $kafedra = (string) $p1['КодКафедры'];
                $kafedra_id = (tables\SpravKafedra::findOne(['name' => $kafedra]))->id;
                if (tables\SpravDis::find()->andWhere(['name' => $name, 'kafedra_id' => $kafedra_id])->count() == 1) {
                    continue;
                }
                $table->kafedra_id = $kafedra_id;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;

                if (!$table->save()) {
                    $this->not_parse_errors = false;
                }
            }
        }
    }

    private function parse_np_table() {
        $path = eval(Paths::$path_to_Планы);
        $path1 = eval(Paths::$path_to_ВидыДеятельности);
        $path2 = eval(Paths::$path_to_Планы);
        $path3 = eval(Paths::$path_to_псГруппы);

        foreach ($path as $p){
            foreach ($path2 as $p2){
                foreach ($path1 as $p1) {
                    foreach ($path3 as $p3) {
                        $table = new tables\Np();

                        $titule = (string) $p['Титул'];
                        $code = explode(" ", $titule);
                        $table->code = $code[2];

                        $titule = (string) $p2['Титул'];
                        $name = explode(" ", $titule);
                        $table->name = implode(' ', array_slice($name, 3));

                        $name = (string) $p1['Наименование'];
                        $type_task_id = (tables\TypeTaskPd::findOne(['name' => $name]))->id;
                        $table->type_task_pd_id = $type_task_id;

                        $index = (string)$p3['КодГруппы'];
                        $comp_ps_id = (tables\CompPs::findOne(['index' => $index]))->id;
                        if (tables\Np::find()->andWhere(['comp_ps_id' => $comp_ps_id, 'type_task_pd_id' => $type_task_id, ])->count() == 1) {
                            continue;
                        }
                        $table->comp_ps_id = $comp_ps_id;

                        $table->created_at = time();
                        $table->created_by = Yii::$app->user->getId();
                        $table->updated_at = time();
                        $table->updated_by = Yii::$app->user->getId();
                        $table->active = 1;
                        $table->lock = 1;

                        if (!$table->save()) {
                            $this->not_parse_errors = false;
                        }
                    }
                }
            }
        }
    }

    private function parse_sprav_uch_god_table(){
        $path = eval(Paths::$path_to_ООП);
        $path1 = eval(Paths::$path_to_Планы);

        foreach ($path as $p) {
            $table = new tables\SpravUchGod();

            $name = (string) $p['Название'];

        }

        foreach ($path1 as $p1){
            $table = new tables\SpravUchGod();
            $uch_god = (string) $p1['УчебныйГод'];
            $years = explode("-", $uch_god);

        }

        foreach ($path1 as $p1){
            $table = new tables\SpravUchGod();


            if (tables\SpravUchGod::find()->andWhere(['year_end' => $years[1], 'name' => $name, 'year_begin' => $years[0]])->count() == 1){
                continue;
            }
            $table->name = $name;
            $table->year_begin = $years[0];
            $table->year_end = $years[1];

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
    }
    private function parse_kurs_table(){
        $path = eval(Paths::$path_to_ПланыГрафикиЯчейки);

        foreach ($path as $p) {
            $table = new tables\Kurs();

            $name = (string) $p['Курс'];
            if (tables\Kurs::find()->andWhere(['number_kurs' => $name])->count() == 1) {
                continue;
            }
            $table->number_kurs = $name;

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
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
        ini_set('max_execution_time', 900);
        $data = file_get_contents($this->file->tempName);
        $this->xml = new \SimpleXMLElement($data);

        $transaction = Yii::$app->db->beginTransaction();

        // сделано
        $this->parse_sroc_education_table(); // 1
        $this->parse_staff_table(); // 2
        $this->parse_fgos_table(); // 3
        $this->parse_kvalification_table(); // 4
        $this->parse_fo_table(); // 5
        $this->parse_prof_standart_table(); // 6
        $this->parse_comp_ps_table(); // 7
        $this->parse_type_task_pd_table(); // 8
        $this->parse_np_table(); // 9
        $this->parse_institut_table(); // 10
        $this->parse_sprav_facultet_table(); // 11
        $this->parse_sprav_kafedra_table(); // 12
        $this->parse_sprav_uch_god(); // 13
//        $this->parse_main_plan_table(); // 14
//        $this->parse_podpisants_table(); // 15
//        $this->parse_comp_table(); // 16 добавить main_plan_id FK
        $this->parse_type_periods_table(); // 17
      $this->parse_comp_ps_has_comp_table(); // 18
        $this->parse_sprav_dis_table(); // 19
        $this->parse_kurs_table(); // 20
//        $this->parse_plan_table(); // 21
        $this->parse_disciplins_table(); // 22
        $this->parse_type_form_table(); // 23 проверить
//        $this->parse_form_table(); // 24 Добавить type_form_id и plan_id
        $this->parse_kaf_has_comp_table(); // 25
        $this->parse_type_work_table(); // 26
        $this->parse_type_session_table(); // 27
        $this->parse_session_table(); // 28
//      $this->parse_dc_table(); // 29
//      $this->parse_calendary_table(); // 30

        // staff np

        $this->save_all($transaction);
    }
}