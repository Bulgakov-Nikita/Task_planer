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
        if (tables\Fgos::find()->andWhere(['number' => $number])->count() == 1) {
            $table = tables\Fgos::findOne(['number' => $number]);
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
        } else {
            $table->number = $number;
            $table->date = $path['ДатаГОСа'];
            $table->path_file = 'null';

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;
        }

        if (!$table->save()) {
            $this->not_parse_errors = false;
        }
    }

    private function parse_comp_table() {
        $path = eval(Paths::$path_to_ПланыКомпетенции);

        foreach ($path as $p) {
            $table = new tables\Comp();

            $index = (integer) $p['ШифрКомпетенции'];
            if (tables\Comp::find()->andWhere(['index' => $index])->count() == 1) {
                $table = tables\Comp::findOne(['index' => $index]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->index = $index;
                $table->soderzhanie = $p['Наименование'];
                // $table->main_plan_id = 1; // временно, потом исправить

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
    }

    private function parse_institut_table() {
        $path = eval(Paths::$path_to_Филиалы);

        foreach ($path as $p) {
            $table = new tables\Institut();

            $name = (string) $p['Полное_название'];
            $code_filiala = (string) $p['Код_филиала'];
            if (tables\Institut::find()->andWhere(['name' => $name, 'code_filiala' => $code_filiala])->count() == 1) {
                $table = tables\Institut::findOne(['name' => $name, 'code_filiala' => $code_filiala]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->name = $name;
                $table->code_filiala = $code_filiala;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

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
            if (tables\TypeTaskPd::find()->andWhere(['name' => $name])->count() == 1) {
                $table = tables\TypeTaskPd::findOne(['name' => $name]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->name = $name;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

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

            if (tables\SpravFacultet::findOne(['name' => $name, 'institut_id' => $institut_id])) {
                $table = tables\SpravFacultet::findOne(['name' => $name, 'institut_id' => $institut_id]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->name = $name;
                $table->institut_id = $institut_id;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
    }

    private function parse_kvalification_table() {
        $path = eval(Paths::$path_to_Планы);
        $table = new tables\Kvalification();

        $name = (string) $path['Квалификация'];
        if (tables\Kvalification::find()->andWhere(['name' => $name])->count() == 1) {
            $table = tables\Kvalification::findOne(['name' => $name]);
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
        } else {
            $table->name = $name;

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;
        }

        if (!$table->save()) {
            $this->not_parse_errors = false;
        }
    }

    private function parse_fo_table() {
        $path = eval(Paths::$path_to_ФормаОбучения);

        foreach ($path as $p){
            $table = new tables\Fo();

            $name = (string) $p['ФормаОбучения'];
            if (tables\Fo::find()->andWhere(['name' => $name])->count() == 1) {
                $table = tables\Fo::findOne(['name' => $name]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->name = $name;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

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
            if (tables\TypeWork::find()->andWhere(['name' => $name])->count() == 1) {
                $table = tables\TypeWork::findOne(['name' => $name]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->name = $name;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

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
            if (tables\TypePeriods::find()->andWhere(['name' => $name])->count() == 1) {
                $table = tables\TypePeriods::findOne(['name' => $name]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->name = $name;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

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
            if (tables\Staff::find()->andWhere(['F' => $F[0], 'I' => $I, 'O' => $O, 'post' => $post])->count() == 1) {
                $table = tables\Staff::findOne(['F' => $F[0], 'I' => $I, 'O' => $O, 'post' => $post]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
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
            }

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
            $table = tables\SrocEducation::findOne(['name' => $name]);
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
        } else {
            $table->name = $name;

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;
        }

        if (!$table->save()) {
            $this->not_parse_errors = false;
        }
    }

    private function parse_prof_standart_table() {
        $path = eval(Paths::$path_to_псСтандарты);
        if ($path['ПриказДата'] == null) { return; }
        $table = new tables\ProfStandart;

        $number = (string) $path['НомерВГруппе'];
        if (tables\ProfStandart::find()->andWhere(['number' => $number])->count() == 1) {
            $table = tables\ProfStandart::findOne(['number' => $number]);
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
        } else {
            $table->number = $number;
            $table->date = $path['ПриказДата'];

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;
        }

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
        if (tables\CompPs::find()->andWhere(['name' => $name, 'index' => $index])->count() == 1) {
            $table = tables\CompPs::findOne(['name' => $name, 'index' => $index]);
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
        }
        else {
            $table->index = $index;
            $table->name = $name;
            $table->prof_standart_id = $standart_id;

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;
        }

        if (!$table->save()) {
            $this->not_parse_errors = false;
        }

        $path = eval(Paths::$path_to_псСтандарты);
        $table = new tables\CompPs();
        $index = (string) $path['НомерВГруппе'];
        $name = (string) $path['НаименованиеСтандарта'];
        if (tables\CompPs::find()->andWhere(['name' => $name, 'index' => $index])->count() == 1) {
            $table = tables\CompPs::findOne(['name' => $name, 'index' => $index]);
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
        } else {
            $table->index = $index;
            $table->name = $name;
            $table->prof_standart_id = $standart_id;

            $table->created_at = time();
            $table->created_by = Yii::$app->user->getId();
            $table->updated_at = time();
            $table->updated_by = Yii::$app->user->getId();
            $table->active = 1;
            $table->lock = 1;
        }

        if (!$table->save()) {
            $this->not_parse_errors = false;
        }

        $path = eval(Paths::$path_to_псОбобщенныеФункции);
        foreach ($path as $p) {
            $table = new tables\CompPs();

            $name = (string) $p['ОбобщеннаяФункция'];
            $index = (string) $p['Шифр'];
            if (tables\CompPs::find()->andWhere(['name' => $name, 'index' => $index])->count() == 1) {
                $table = tables\CompPs::findOne(['name' => $name, 'index' => $index]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
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
            }

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }

        $path = eval(Paths::$path_to_псФункции);
        foreach ($path as $p) {
            $table = new tables\CompPs();

            $name = (string) $p['Функция'];
            $index = (string) $p['Шифр'];
            if (tables\CompPs::find()->andWhere(['name' => $name, 'index' => $index])->count() == 1) {
                $table = tables\CompPs::findOne(['name' => $name, 'index' => $index]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->name = $name;
                $table->index = $index;
                $table->prof_standart_id = $standart_id;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

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
            if (tables\TypeSession::find()->andWhere(['name' => $name])->count() == 1){
                $table = tables\TypeSession::findOne(['name' => $name]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->name = $name;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
    }

    private function parse_session_table() {
        $path = eval(Paths::$path_to_Планы);
        $path1 = eval(Paths::$path_to_Заезды);
        $path2 = eval(Paths::$path_to_СправочникВидыРабот);
        $path3 = eval(Paths::$path_to_);

        foreach ($path as $p){
            $table = new tables\Session();

            $data = (string) $p['ЧислоСессий'];
            foreach ($path1 as $p1){
                $table = new table\Session();
                $type_session = (string) $p1['Название'];
                $type_session_id = (tables\TypeSession::findOne(['name' => $type_session]))->id;
                foreach ($path2 as $p2){
                    $table = new table\Session();
                    $type_work = (string) $p2['Название'];
                    $type_work_id = (tables\TypeWork::findOne(['name' => $type_work]))->id;
                    foreach ($path3 as $p3){
                        $table = new table\Session();
                        $plan = (string) $p3[''];
                        $plan_id = (tables\Plan::findOne(['' => $tplan]))->id;
                        if (tables\Session::find()->andWhere(['data' => $data, 'type_session_id' => $type_session_id, 'type_work_id' => $type_work_id])->count() == 1){
                            $table = tables\Session::findOne(['data' => $data, 'type_session_id' => $type_session_id, 'type_work_id' => $type_work_id]);
                            $table->updated_at = time();
                            $table->updated_by = Yii::$app->user->getId();
                        } else {

                            $table->data = $data;
                            $table->type_form_id = $type_form_id;
                            $table->disciplins_id = $disciplins_id;

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
    }

    private function parse_form_table() {
        $path = eval(Paths::$path_to_СправочникТипОбъекта);
        $path1 = eval(Paths::$path_to_СправочникТипОбъекта);
        $path2 = eval(Paths::$path_to_ПланыСтроки);

        foreach ($path as $p){
            $table = new tables\Form();

            $data = (string) $p['Код'];
            foreach ($path1 as $p1){
                $table = new table\Form();
                $type_form = (string) $p1['Наименование'];
                $type_form_id = (tables\TypeForm::findOne(['name' => $type_form]))->id;
                foreach ($path2 as $p2){
                    $table = new table\Form();
                    $disciplins = (string) $p2['Дисциплина'];
                    $disciplins_id = (tables\Disciplins::findOne(['index' => $disciplins]))->id;
                    if (tables\Form::find()->andWhere(['data' => $data, 'type_form_id' => $type_form_id, 'disciplins_id' => $disciplins_id])->count() == 1){
                        $table = tables\Form::findOne(['data' => $data, 'type_form_id' => $type_form_id, 'disciplins_id' => $disciplins_id]);
                        $table->updated_at = time();
                        $table->updated_by = Yii::$app->user->getId();
                    } else {

                        $table->data = $data;
                        $table->type_form_id = $type_form_id;
                        $table->disciplins_id = $disciplins_id;

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
                    $table = tables\SpravKafedra::findOne(['name' => $name, 'sprav_facultet_id' => $facultet_id]);
                    $table->updated_at = time();
                    $table->updated_by = Yii::$app->user->getId();
                } else {
                    $table->sprav_facultet_id = $facultet_id;

                    $table->created_at = time();
                    $table->created_by = Yii::$app->user->getId();
                    $table->updated_at = time();
                    $table->updated_by = Yii::$app->user->getId();
                    $table->active = 1;
                    $table->lock = 1;
                }

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
                    $table = tables\SpravDis::findOne(['name' => $name, 'sprav_kafedra_id' => $kafedra_id]);
                    $table->updated_at = time();
                    $table->updated_by = Yii::$app->user->getId();
                } else {
                    $table->sprav_kafedra_id = $kafedra_id;

                    $table->created_at = time();
                    $table->created_by = Yii::$app->user->getId();
                    $table->updated_at = time();
                    $table->updated_by = Yii::$app->user->getId();
                    $table->active = 1;
                    $table->lock = 1;
                }

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
                $table = tables\TypeForm::findOne(['name' => $name]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->name = $name;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

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
                if (tables\SpravDis::find()->andWhere(['name' => $name, 'sprav_kafedra_id' => $kafedra_id])->count() == 1) {
                    $table = tables\SpravDis::findOne(['name' => $name, 'sprav_kafedra_id' => $kafedra_id]);
                    $table->updated_at = time();
                    $table->updated_by = Yii::$app->user->getId();
                } else {
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
    }

    private function parse_kaf_has_comp_table() {
        $path = eval(Paths::$path_to_ПланыКомпетенции);
        $path1 = eval(Paths::$path_to_Кафедры);

        foreach ($path as $p) {
            $table = new tables\KafHasComp();

            $comp = (string) $p['ШифрКомпетенции'];
            $comp_id = (table\Comp::findOne(['index' => $comp]))->id;

            foreach ($path1 as $p1) {
                $table = new table\KafHasComp();

                $kafedra = (string) $p1['Название'];
                $kafedra_id = (tables\SpravKafedra::findOne(['name' => $kafedra]))->id;
                if (tables\KafHasComp::find()->andWhere(['name' => $name, 'sprav_kafedra_id' => $kafedra_id])->count() == 1) {
                    $table = tables\KafHasComp::findOne(['name' => $name, 'sprav_kafedra_id' => $kafedra_id]);
                        $table->updated_at = time();
                        $table->updated_by = Yii::$app->user->getId();
                } else {
                    $table->comp_id = $comp_id;
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
    }

    private function parse_np_table() {
        $path_oop = eval(Paths::$path_to_ООП);
        $path_activites = eval(Paths::$path_to_ВидыДеятельности);
        $path_ps_standarts = eval(Paths::$path_to_псСтандарты);

        $code =  (string) $path_oop['Шифр'];
        $name = (string) $path_oop['Название'];

        $ps_name = (string) $path_ps_standarts['НаименованиеСтандарта'];
        $comp_ps_id = '';
        if (!($ps_name == '')) {
            $comp_ps_id = (tables\CompPs::findOne(['name' => $ps_name]))->id;
        }

        foreach ($path_activites as $active) {
            $table = new tables\Np();

            $active_name = (string) $active['Наименование'];
            $type_task_pd_id = (tables\TypeTaskPd::findOne(['name' => $active_name]))->id;

            if (tables\Np::find()->andWhere(['code' => $code, 'name' => $name, 'type_task_pd_id' => $type_task_pd_id])->count() == 1) {
                $table = tables\Np::findOne(['code' => $code, 'name' => $name, 'type_task_pd_id' => $type_task_pd_id]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->name = $name;
                $table->code = $code;
                $table->comp_ps_id = $comp_ps_id;
                $table->type_task_pd_id = $type_task_pd_id;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }

    }

    private function parse_sprav_uch_god_table(){
        $path = eval(Paths::$path_to_ООП);
        $path1 = eval(Paths::$path_to_Планы);

        foreach ($path as $p) {
            $name = (string) $p['Название'];
        }

        foreach ($path1 as $p1){
            $uch_god = (string) $p1['УчебныйГод'];
            $years = explode("-", $uch_god);
        }

        foreach ($path1 as $p1){
            $table = new tables\SpravUchGod();

            if (tables\SpravUchGod::find()->andWhere(['year_end' => $years[1], 'name' => $name, 'year_begin' => $years[0]])->count() == 1){
                $table = tables\SpravUchGod::findOne(['year_end' => $years[1], 'name' => $name, 'year_begin' => $years[0]]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->name = $name;
                $table->year_begin = $years[0];
                $table->year_end = $years[1];

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

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
                $table = tables\Kurs::findOne(['number_kurs' => $name]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->number_kurs = $name;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }

            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
    }

    private function parse_dc_table(){
        $path = eval(Paths::$path_to_ПланыКомпетенции);
        $path1 = eval(Paths::$path_to_ПланыСтроки);

        foreach ($path as $p) {
            $table = new table\Dc();
            $comp = (string) $p['ШифрКомпетенции'];
            $comp_id = (tables\Comp::findOne(['index' => $comp]))->id;
            foreach ($path1 as $p1){
                $table = new tables\Dc();

                $disciplins = (string) $p1['Дисциплина'];
                $disciplins_id = (tables\Disciplins::findOne(['index' => $disciplins]))->id;

                if (tables\Dc::find()->andWhere(['comp_id' => $comp_id, 'disciplins_id' => $disciplins_id])->count() == 1) {
                    $table = tables\Dc::findOne(['comp_id' => $comp_id, 'disciplins_id' => $disciplins_id]);
                    $table->updated_at = time();
                    $table->updated_by = Yii::$app->user->getId();
                } else {
                    $table->comp_id = $comp_id;
                    $table->disciplins_id = $disciplins_id;

                    $table->created_at = time();
                    $table->created_by = Yii::$app->user->getId();
                    $table->updated_at = time();
                    $table->updated_by = Yii::$app->user->getId();
                    $table->active = 1;
                    $table->lock = 1;
                }

                if (!$table->save()) {
                    $this->not_parse_errors = false;
                }
            }
        }
    }

    private function parse_main_plan_table() {
        $path_plans = eval(Paths::$path_to_Планы);
        $path_parametrs_plan = eval(Paths::$path_to_ПараметрыПлана);
        $path_kafedrs = eval(Paths::$path_to_Кафедры);
        $path_oop = eval(Paths::$path_to_ООП);
        $path_fo = eval(Paths::$path_to_ФормаОбучения);
        $path_dl_plans = eval(Paths::$path_to_ДолжЛица_Планы);
        $path_dl = eval(Paths::$path_to_ДолжностныеЛица);

        $date_sp = (string) $path_plans['ГодНачалаПодготовки'];
        $date_education = (string) $path_plans['УчебныйГод'];
        $date_ut = (string) $path_plans['ДатаУтверСоветом'];

        $organization_code = (string) $path_plans['КодОрганизации'];
        $name_or = (tables\Institut::findOne(['code_filiala' => $organization_code]))->name;
        $name_ministry = (string) $path_parametrs_plan['RUPMinistry'];
        $protocol_number = (string) $path_plans['НомПротокСовета'];
        $protocol_date = (string) $path_plans['ДатаУтверСоветом'];

        $fgos_number = (string) $path_plans['НомерФГОС'];
        $fgos_id = (tables\Fgos::findOne(['number' => $fgos_number]))->id;

        $code_kafedra = (string) $path_plans['КодПрофКафедры'];
        $name_kafedra = '';
        foreach ($path_kafedrs as $kafedra) {
            if (((string) $kafedra['Код']) == $code_kafedra) {
                $name_kafedra = (string) $kafedra['Название'];
                break;
            }
        }
        $sprav_kafedra_id = (tables\SpravKafedra::findOne(['name' => $name_kafedra]))->id;

        $name_kvalification = (string) $path_plans['Квалификация'];
        $kvalification_id = (tables\Kvalification::findOne(['name' => $name_kvalification]))->id;


        $code_fo = (string) $path_plans['КодФормыОбучения'];
        $name_fo = '';
        foreach ($path_fo as $fo) {
            if (((string) $fo['Код']) == $code_fo) {
                $name_fo = (string) $fo['ФормаОбучения'];
                break;
            }
        }
        $fo_id = (tables\Fo::findOne(['name' => $name_fo]))->id;

        $do_code = '';
        foreach ($path_dl_plans as $dl) {
            if (((string) $dl['Утвердил']) == 'true') {
                $do_code = (string) $dl['КодДолжЛица'];
                break;
            }
        }
        $dl_f = ''; $dl_n = ''; $dl_o = '';
        foreach ($path_dl as $dl) {
            if (((string) $dl['Код']) == $do_code) {
                $fio = explode(' ', (string) $dl['ФИО']);
                $dl_f = $fio[0];
                $dl_n = explode('.', $fio[1])[0];
                $dl_o = explode('.', $fio[1])[1];
                break;
            }
        }
        $staff_id = (tables\Staff::findOne(['F' => $dl_f, 'I' => $dl_n, 'O' => $dl_o]))->id;

        $training_period = ((string) $path_plans['СрокОбучения']) . 'г ' . ((string) $path_plans['СрокОбученияМесяцев']) . 'м';
        $sroc_education_id = (tables\SrocEducation::findOne(['name' => $training_period]))->id;

        $years = explode('-', (string) $path_plans['УчебныйГод']);
        $year_begin = $years[0];
        $year_end = $years[1];
        $facultet_name = (string) $path_oop['Название'];
        $sprav_uch_god_id = (tables\SpravUchGod::findOne(['name' => $facultet_name,
            'year_begin' => $year_begin,
            'year_end' => $year_end]))->id;

        $name_np = (string) $path_oop['Название'];
        $all_np = (tables\Np::findAll(['name' => $name_np]));

        foreach ($all_np as $np) {
            $table = new tables\MainPlan();
            $np_id = $np->id;

            if (tables\MainPlan::find()->andWhere([
                    'date_sp' => $date_sp,
                    'date_education' => $date_education,
                    'date_ut' => $date_ut,
                    'name_or' => $name_or,
                    'name_ministry' => $name_ministry,
                    'n_protocol' => $protocol_number,
                    'date_protocol' => $protocol_date,
                    'fgos_id' => $fgos_id,
                    'sprav_kafedra_id' => $sprav_kafedra_id,
                    'kvalification_id' => $kvalification_id,
                    'np_id' => $np_id,
                    'fo_id' => $fo_id,
                    'staff_id' => $staff_id,
                    'sroc_education_id' => $sroc_education_id,
                    'sprav_uch_god_id' => $sprav_uch_god_id,
                ])->count() == 1) {
                $table = tables\MainPlan::findOne([
                    'date_sp' => $date_sp,
                    'date_education' => $date_education,
                    'date_ut' => $date_ut,
                    'name_or' => $name_or,
                    'name_ministry' => $name_ministry,
                    'n_protocol' => $protocol_number,
                    'date_protocol' => $protocol_date,
                    'fgos_id' => $fgos_id,
                    'sprav_kafedra_id' => $sprav_kafedra_id,
                    'kvalification_id' => $kvalification_id,
                    'np_id' => $np_id,
                    'fo_id' => $fo_id,
                    'staff_id' => $staff_id,
                    'sroc_education_id' => $sroc_education_id,
                    'sprav_uch_god_id' => $sprav_uch_god_id,
                ]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->date_sp = $date_sp;
                $table->date_education = $date_education;
                $table->date_ut = $date_ut;
                $table->name_or = $name_or;
                $table->name_ministry = $name_ministry;
                $table->n_protocol = $protocol_number;
                $table->date_protocol = $protocol_date;
                $table->fgos_id = $fgos_id;
                $table->sprav_kafedra_id = $sprav_kafedra_id;
                $table->kvalification_id = $kvalification_id;
                $table->np_id = $np_id;
                $table->fo_id = $fo_id;
                $table->staff_id = $staff_id;
                $table->sroc_education_id = $sroc_education_id;
                $table->sprav_uch_god_id = $sprav_uch_god_id;

                $table->created_at = time();
                $table->created_by = Yii::$app->user->getId();
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
                $table->active = 1;
                $table->lock = 1;
            }
            if (!$table->save()) {
                $this->not_parse_errors = false;
            }
        }
    }
    private function parse_plan_table(){
        $path = eval(Paths::$path_to_Кафедры);
        $path1 = eval(Paths::$path_to_ПланыГрафикиЯчейки);
        $path2 = eval(Paths::$path_to_);

        foreach ($path as $p) {
            $table = new table\Plan();

            $sprav_kafedra = (string) $p['Название'];
            $sprav_kafedra_id = (tables\SpravKafedra::findOne(['name' => $sprav_kafedra]))->id;
            foreach ($path1 as $p1){
                $table = new tables\Plan();

                $kurs = (string) $p1['Курс'];
                $kurs_id = (tables\Kurs::findOne(['number_kurs' => $kurs]))->id;

                if (tables\Dc::find()->andWhere(['sprav_kafedra_id' => $sprav_kafedra_id, 'kurs_id' => $kurs_id])->count() == 1) { continue;
                }
                    $table->sprav_kafedra_id = $sprav_kafedra_id;
                    $table->kurs_id = $kurs_id;

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
    private function parse_period_table(){
        $path = eval(Paths::$path_to_ПланыГрафикиЯчейки);
        $path1 = eval(Paths::$path_to_);
        $path2 = eval(Paths::$path_to_ПланыГрафикиЯчейки);
        $path3 = eval(Paths::$path_to_ПланыГрафикиЯчейки);

        foreach ($path as $p) {
            $table = new table\Period();

            $begin = (string) $p['НомерПервойНедели'];
            foreach ($path1 as $p1){
                $table = new tables\Period();

                $end = (string) $p1[''];
                foreach ($path2 as $p2){
                    $table = new table\Period();

                    $semestr = (string) $p2['Семестр'];
                    foreach ($path3 as $p3){
                        $table = new table\Period();

                        $type_period = (string) $p3['КодВидаДеятельности'];
                        $type_period_id = (table\TypePeriod::findOne(['name' => $type_period]))->id;
                        if (tables\Period::find()->andWhere(['begin' => $begin, 'end' => $end, 'semestr' => $semestr, 'type_period_id' => $type_period_id])->count() == 1) { continue;
                        }
                            $table->begin = $begin;
                            $table->end = $end;
                            $table->semestr = $semestr;
                            $table->type_period_id = $type_period_id;

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
    private function parse_podpisants_table(){
        $path = eval(Paths::$path_to_ДолжностныеЛица);
        $path1 = eval(Paths::$path_to_);

        foreach ($path as $p) {
            $table = new table\Podoisants();

            $staff = (string) $p['ФИО'];
            $staff_id = (tables\Staff::findOne(['f' => $staff]))->id;
            foreach ($path1 as $p1){
                $table = new tables\Podoisants();

                $main_plan = (string) $p1[''];
                $main_plan_id = (tables\MainPlan::findOne(['' => $main_plan]))->id;

                if (tables\Podoisants::find()->andWhere(['staff_id' => $staff_id, 'main_plan_id' => $main_plan_id])->count() == 1) { continue;
                }
                    $table->staff_id = $staff_id;
                    $table->main_plan_id = $main_plan_id;

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
    private function parse_calendary_table(){
        $path = eval(Paths::$path_to_ПланыГрафикиЯчейки);
        $path1 = eval(Paths::$path_to_ПланыГрафикиЯчейки);
        $path2 = eval(Paths::$path_to_);

        foreach ($path as $p) {
            $table = new table\Calendary();

            $kurs = (string) $p['Курс'];
            $kurs_id = (tables\Kurs::findOne(['number_kurs' => $kurs]))->id;
            foreach ($path1 as $p1){
                $table = new tables\Calendary();

                $period = (string) $p1['Семестр'];
                $period_id = (tables\Period::findOne(['semestr' => $period]))->id;
                foreach ($path2 as $p2){
                    $table = new table\Calendary();

                    $main_plan = (string) $p2[''];
                    $main_plan_id = (table\MainPlan::findOne(['' => $main_plan]))->id;

                    if (tables\Calendary::find()->andWhere(['kurs_id' => $kurs_id, 'semest_id' => $semestr_id, 'main_plan_id' => $main_plan_id])->count() == 1) { continue;
                    }
                        $table->kurs_id = $kurs_id;
                        $table->semestr_id = $semestr_id;
                        $table->main_plan_id = $main_plan_id;

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
        $this->parse_sprav_uch_god_table(); // 13
        $this->parse_main_plan_table(); // 14
//        $this->parse_podpisants_table(); // 15 добавить main_plan_id FK
//        $this->parse_comp_table(); // 16 добавить main_plan_id FK
        $this->parse_type_periods_table(); // 17
//      $this->parse_period_table(); // 18  
//      $this->parse_comp_ps_has_comp_table(); // 19 (Создана функция)
        $this->parse_sprav_dis_table(); // 20
        $this->parse_kurs_table(); // 21
//        $this->parse_plan_table(); // 22 (Создана функция) добавить main_plan_id FK
        $this->parse_disciplins_table(); // 23 добавить апдейт(Готово) доделать plan_id FK
        $this->parse_type_form_table(); // 24
//        $this->parse_form_table(); // 25 Добавить type_form_id(Готово) + добавить апдейт(Готово)
        $this->parse_kaf_has_comp_table(); // 26 добавить апдейт(Готово)
        $this->parse_type_work_table(); // 27
        $this->parse_type_session_table(); // 28
//        $this->parse_session_table(); // 29 (Создана функция), доделать plan_id FK
//        $this->parse_dc_table(); // 30 (Создана функция)
//      $this->parse_calendary_table(); // 31 добавить main_plan_id FK

        // staff np

        $this->save_all($transaction);
    }
}