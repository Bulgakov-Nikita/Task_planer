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
        $path_plans = eval(Paths::$path_to_Планы);

        $fgos = (string) $path_plans['НомерФГОС'];
        $fgos_id = tables\Fgos::findOne(['number' => $fgos])->id;
        $all_main_plan = tables\MainPlan::findAll(['fgos_id' => $fgos_id]);

        foreach ($all_main_plan as $main_plan) {
            $main_plan_id = $main_plan->id;
            foreach ($path as $p) {
                $table = new tables\Comp();

                $index = (string) $p['ШифрКомпетенции'];
                if (tables\Comp::find()->andWhere(['index' => $index, 'main_plan_id' => $main_plan_id])->count() == 1) {
                    $table = tables\Comp::findOne(['index' => $index, 'main_plan_id' => $main_plan_id]);
                    $table->updated_at = time();
                    $table->updated_by = Yii::$app->user->getId();
                } else {
                    $table->index = $index;
                    $table->soderzhanie = $p['Наименование'];
                    $table->main_plan_id = $main_plan_id;

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
        $table = new tables\TypeTaskPd();

        $path = eval(Paths::$path_to_ВидыДеятельности);
        $path_pvd = eval(Paths::$path_to_ПланыВидыДеятельности);

        $np_code = (string) $path_pvd['КодВидаДеятельности'];
        $name = '';
        foreach ($path as $p) {
            if (((string) $p['Код']) == $np_code) {
                $name = (string) $p['Наименование'];
                break;
            }
        }

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

    private function parse_sprav_facultet_table() {
        $path = eval(Paths::$path_to_Факультеты);

        foreach ($path as $p) {
            $table = new tables\SpravFacultet();

            $name = (string) $p['Факультет'];
            $filial_code = (int) $p['Код_филиала'];
            $institut_id = (tables\Institut::findOne(['code_filiala' => $filial_code]))->id;

            if (tables\SpravFacultet::find()->andWhere(['name' => $name, 'institut_id' => $institut_id])->count() == 1) {
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

    private function parse_form_table() {
        $path_object_types = eval(Paths::$path_to_СправочникТипОбъекта);
        $path_dis = eval(Paths::$path_to_ПланыСтроки);

        foreach ($path_object_types as $type_object) {
            $data = (string) $type_object['Код'];

            $name_form = (string) $type_object['Название'];
            $type_form_id = (tables\TypeForm::findOne(['name' => $name_form]))->id;

            foreach ($path_dis as $pd){
                $table = new tables\Form();
                $disciplins = (string) $pd['ДисциплинаКод'];
                $disciplins_id = (tables\Disciplins::findOne(['index' => $disciplins]))->id;

                if (tables\Form::find()->andWhere([
                        'type_form_id' => $type_form_id,
                        'disciplins_id' => $disciplins_id,
                    ])->count() == 1) {
                    $table = tables\Form::findOne([
                        'type_form_id' => $type_form_id,
                        'disciplins_id' => $disciplins_id,
                    ]);
                    $table->updated_at = time();
                    $table->updated_by = Yii::$app->user->getId();
                }
                $table->data = $data;
                $table->type_form_id = $type_form_id;
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
        $path_plans_cycle = eval(Paths::$path_to_ПланыЦиклы);
        $path_kaders = eval(Paths::$path_to_Кафедры);
        $path_plans = eval(Paths::$path_to_Планы);
        $path_dis = eval(Paths::$path_to_ПланыСтроки);
        $path_plan = eval(Paths::$path_to_ООП);

        $kafedra_code = (string) $path_plans['КодПрофКафедры'];
        $kafedra_name = '';
        foreach ($path_kaders as $kafedra) {
            if (((string) $kafedra['Код']) == $kafedra_code) {
                $kafedra_name = (string) $kafedra['Название'];
                break;
            }
        }
        $kafedra_id = (tables\SpravKafedra::findOne(['name' => $kafedra_name]))->id;

        foreach ($path_dis as $pd) {
            $table = new tables\Disciplins();

            $index = (string) $pd['ДисциплинаКод'];

            $sprav_dis = (string) $pd['Дисциплина'];
            $sprav_dis_id = (tables\SpravDis::findOne(['name' => $sprav_dis]))->id;

            $np_name = (string) $path_plan['Название'];
            $all_np = tables\Np::findAll(['name' => $np_name]);
            foreach ($all_np as $np) {
                $plan = $np->id;
                $plan_id = (tables\Plan::findOne(['main_plan_id' => $plan]))->id;
            }
            if (tables\Disciplins::find()->andWhere([
                    'sprav_kafedra_id' => $kafedra_id,
                    'sprav_dis_id' => $sprav_dis_id,
                    'plan_id' => $plan_id,
                    'index' => $index,
                ])->count() == 1){
                $table = tables\Disciplins::findOne([
                    'sprav_kafedra_id' => $kafedra_id,
                    'sprav_dis_id' => $sprav_dis_id,
                    'plan_id' => $plan_id,
                    'index' => $index,
                ]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->index = $index;
                $table->sprav_kafedra_id = $kafedra_id;
                $table->sprav_dis_id = $sprav_dis_id;
                $table->plan_id = $plan_id;

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
        foreach ($path_plans_cycle as $ppc){
            $table = new tables\Disciplins();

            $index = (string) $ppc['Идентификатор'];

            $np_name = (string) $path_plan['Название'];
            $all_np = tables\Np::findAll(['name' => $np_name]);
            foreach ($all_np as $np) {
                $plan = $np->id;
                $plan_id = (tables\Plan::findOne(['main_plan_id' => $plan]))->id;
            }
            if (tables\Disciplins::find()->andWhere([
                    'sprav_kafedra_id' => $kafedra_id,
                    'plan_id' => $plan_id,
                    'index' => $index,
                ])->count() == 1){
                $table = tables\Disciplins::findOne([
                    'sprav_kafedra_id' => $kafedra_id,
                    'plan_id' => $plan_id,
                    'index' => $index,
                ]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->index = $index;
                $table->sprav_kafedra_id = $kafedra_id;
                $table->plan_id = $plan_id;

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

    private function parse_np_table() {
        $table = new tables\Np();

        $path_oop = eval(Paths::$path_to_ООП);
        $path_activites = eval(Paths::$path_to_ВидыДеятельности);
        $path_ps_standarts = eval(Paths::$path_to_псСтандарты);
        $path_pvd = eval(Paths::$path_to_ПланыВидыДеятельности);

        $code =  (string) $path_oop['Шифр'];
        $name = (string) $path_oop['Название'];

        $ps_name = (string) $path_ps_standarts['НаименованиеСтандарта'];
        $comp_ps_id = '';
        if (!($ps_name == '')) {
            $comp_ps_id = (tables\CompPs::findOne(['name' => $ps_name]))->id;
        }

        $vd_code = (string) $path_pvd['КодВидаДеятельности'];
        $vd_name = '';
        foreach ($path_activites as $active) {
            if (((string) $active['Код']) == $vd_code) {
                $vd_name = (string) $active['Наименование'];
                break;
            }
        }
        $type_task_pd_id = (tables\TypeTaskPd::findOne(['name' => $vd_name]))->id;

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
        $path = eval(Paths::$path_to_Планы);

        $number_courses = (string) $path['ЧислоКурсов'];
        for ($course = 1; $course <= (integer) $number_courses; $course++) {
            $table = new tables\Kurs();

            $name = $course;
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

    private function parse_main_plan_table() {
        $table = new tables\MainPlan();

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

        $np_name = (string) $path_oop['Название'];
        $np_id = (tables\Np::findOne(['name' => $np_name]))->id;

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

    private function parse_podpisants_table() {
        $path_dl = eval(Paths::$path_to_ДолжностныеЛица);
        $path_dl_plans = eval(Paths::$path_to_ДолжЛица_Планы);

        $do_id = '';
        foreach ($path_dl_plans as $dl) {
                if (((string) $dl['Утвердил']) == 'true') {
                    $do_id = (string) $dl['КодДолжЛица'];
                    break;
                }
            }
        $dl_f = ''; $dl_n = ''; $dl_o = '';
        foreach ($path_dl as $dl) {
            if (((string) $dl['Код']) == $do_id) {
                $fio = explode(' ', (string) $dl['ФИО']);
                $dl_f = $fio[0];
                $dl_n = explode('.', $fio[1])[0];
                $dl_o = explode('.', $fio[1])[1];
                break;
            }
        }
        $staff_id = (tables\Staff::findOne(['F' => $dl_f, 'I' => $dl_n, 'O' => $dl_o]))->id;

        $all_main_plans = tables\MainPlan::findAll(['staff_id' => $staff_id]);
        foreach ($all_main_plans as $main_plan) {
            $table = new tables\Podpisants();
            $main_plan_id = $main_plan->id;

            if (tables\Podpisants::find()->andWhere(['staff_id' => $staff_id, 'main_plan_id' => $main_plan_id])->count() == 1) {
                $table = tables\Podpisants::findOne(['staff_id' => $staff_id, 'main_plan_id' => $main_plan_id]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->staff_id = $staff_id;
                $table->main_plan_id = $main_plan_id;

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

    private function parse_comp_ps_has_comp_table() {
        $path = eval(Paths::$path_to_псГруппы);
        if ($path['Группа'] == null) { return; }

        $path_pk_ps_functions = eval(Paths::$path_to_ПланыКомпетенцииПрофСтандарты);
        $path_ps_functions = eval(Paths::$path_to_псФункции);
        $path_pk = eval(Paths::$path_to_ПланыКомпетенции);

        foreach ($path_pk_ps_functions as $pk_ps_function) {
            $table = new tables\CompPsHasComp();

            $code_pk = (string) $pk_ps_function['КодКомпетенции'];
            $code_ps_function = (string) $pk_ps_function['КодТФ'];

            $name = '';
            foreach ($path_pk as $pk) {
                if (((string) $pk['Код']) == $code_pk) {
                    $name = (string) $pk['Наименование'];
                    break;
                }
            }
            $comp_id = (tables\Comp::findOne(['soderzhanie' => $name]))->id;

            $func_name = '';
            foreach ($path_ps_functions as $function) {
                if (((string) $function['Код']) == $code_ps_function) {
                    $func_name = (string) $function['Функция'];
                    break;
                }
            }
            $comp_ps_id = (tables\CompPs::findOne(['name' => $func_name]))->id;

            if (tables\CompPsHasComp::find()->andWhere(['comp_id' => $comp_id, 'comp_ps_id' => $comp_ps_id])->count() == 1) {
                $table = tables\CompPsHasComp::findOne(['comp_id' => $comp_id, 'comp_ps_id' => $comp_ps_id]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->comp_ps_id = $comp_ps_id;
                $table->comp_id = $comp_id;

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
        $path_courses = eval(Paths::$path_to_Заезды);
        $path_plans = eval(Paths::$path_to_Планы);
        $path_kafedrs = eval(Paths::$path_to_Кафедры);
        $path_oop = eval(Paths::$path_to_ООП);

        $kafedra_code = (string) $path_plans['КодПрофКафедры'];
        $kafedra_name = '';
        foreach ($path_kafedrs as $kafedra) {
            if (((string) $kafedra['Код']) == $kafedra_code) {
                $kafedra_name = (string) $kafedra['Название'];
                break;
            }
        }
        $kafedra_id = (tables\SpravKafedra::findOne(['name' => $kafedra_name]))->id;

        foreach ($path_courses as $course) {
            $kurs = (string) $course['Курс'];
            $kurs_id = (tables\Kurs::findOne(['number_kurs' => $kurs]))->id;

            $np_name = (string) $path_oop['Название'];
            $all_np = tables\Np::findAll(['name' => $np_name]);
            foreach ($all_np as $np) {
                $table = new tables\Plan();

                $np_id = $np->id;
                $main_plan_id = (tables\MainPlan::findOne(['np_id' => $np_id]))->id;

                if (tables\Plan::find()->andWhere([
                        'main_plan_id' => $main_plan_id,
                        'kurs_id' => $kurs_id,
                        'sprav_kafedra_id' => $kafedra_id])->count() == 1) {
                    $table = tables\Plan::findOne([
                        'main_plan_id' => $main_plan_id,
                        'kurs_id' => $kurs_id,
                        'sprav_kafedra_id' => $kafedra_id]);
                    $table->updated_at = time();
                    $table->updated_by = Yii::$app->user->getId();
                } else {
                    $table->kurs_id = $kurs_id;
                    $table->main_plan_id = $main_plan_id;
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

    private function parse_period_table() {
        $path_cells = eval(Paths::$path_to_ПланыГрафикиЯчейки);
        $path_plans = eval(Paths::$path_to_Планы);
        $path_oop = eval(Paths::$path_to_ООП);

        $year = (string) $path_plans['ГодНачалаПодготовки'];
        $start_date = new \DateTime("$year-09-01");

        foreach ($path_cells as $cell) {
            $table = new tables\Period();

            $semestr = (string) $cell['Семестр'];
            $course = (string) $cell['Курс'];

            $period_number = (string) $cell['КодВидаДеятельности'];
            $type_periods_id = (tables\TypePeriods::findOne(['name' => $period_number]))->id;

            $np_name = (string) $path_oop['Название'];
            $np_id = (tables\Np::findOne(['name' => $np_name]))->id;
            $main_plan_id = (tables\MainPlan::findOne(['np_id' => $np_id]))->id;

            $date = new \DateTime($start_date->format('c'));
            $days = ((integer) $cell['НомерНедели']) * 7;

            if (((string) $cell['КоличествоЧастейВНеделе'] == '6')) {
                $date->add(new \DateInterval('P' . $days . 'D'));
                $begin = $date->format('Y-m-d');
                $date->add(new \DateInterval('P6D'));
                $end = $date->format('Y-m-d');
            } else {
                $days += ((integer) $cell['НомерЧастиНедели']) - 1;
                $date->add(new \DateInterval('P' . $days . 'D'));
                $begin = $date->format('Y-m-d');
                $end = $date->format('Y-m-d');
            }

            if (tables\Period::find()->andWhere([
                    'begin' => $begin,
                    'end' => $end,
                    'semestr' => $semestr,
                    'course' => $course,
                    'type_periods_id' => $type_periods_id,
                    'main_plan_id' => $main_plan_id,
                    ])->count() == 1) {
                $table = tables\Period::findOne([
                    'begin' => $begin,
                    'end' => $end,
                    'semestr' => $semestr,
                    'course' => $course,
                    'type_periods_id' => $type_periods_id,
                    'main_plan_id' => $main_plan_id,
                ]);
                $table->updated_at = time();
                $table->updated_by = Yii::$app->user->getId();
            } else {
                $table->begin = $begin;
                $table->end = $end;
                $table->semestr = $semestr;
                $table->course = $course;
                $table->type_periods_id = $type_periods_id;
                $table->main_plan_id = $main_plan_id;

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
        $path_plans = eval(Paths::$path_to_Планы);
        $path_sessions = eval(Paths::$path_to_Заезды);
        $path_oop = eval(Paths::$path_to_ООП);
        $path_selected_types_work = eval(Paths::$path_to_ВыбранныеВидыРабот);
        $path_sprav_type_works = eval(Paths::$path_to_СправочникВидыРабот);

        $np_name = (string) $path_oop['Название'];
        $np_id = (tables\Np::findOne(['name' => $np_name]))->id;
        $main_plan_id = (tables\MainPlan::findOne(['np_id' => $np_id]))->id;

        $data = (string) $path_plans['ЧислоСессий'];

        foreach ($path_sessions as $session) {
            $session_name = (string) $session['Название'];
            $type_session_id = (tables\TypeSession::findOne(['name' => $session_name]))->id;

            $number_courses = (string) $path_plans['ЧислоКурсов'];
            for ($course = 1; $course <= (integer) $number_courses; $course++) {
                $kurs_id = (tables\Kurs::findOne(['number_kurs' => $course]))->id;
                $plan_id = (tables\Plan::findOne(['kurs_id' => $kurs_id, 'main_plan_id' => $main_plan_id]))->id;

                foreach ($path_selected_types_work as $selected_type_work) {
                    $type_work_code = (string) $selected_type_work['КодВидаРабот'];
                    $selected_type_work_name = '';
                    foreach ($path_sprav_type_works as $type_work) {
                        if (((string) $type_work['Код']) == $type_work_code) {
                            $selected_type_work_name = (string) $type_work['Название'];
                        }
                    }
                    $type_work_id = (tables\TypeWork::findOne(['name' => $selected_type_work_name]))->id;

                    $table = new tables\Session();
                    if (tables\Session::find()->andWhere([
                            'data' => $data,
                            'type_work_id' => $type_work_id,
                            'plan_id' => $plan_id,
                            'type_session_id' => $type_session_id,
                        ])->count() == 1) {
                        $table = tables\Session::findOne([
                                'data' => $data,
                                'type_work_id' => $type_work_id,
                                'plan_id' => $plan_id,
                                'type_session_id' => $type_session_id,
                        ]);
                        $table->updated_at = time();
                        $table->updated_by = Yii::$app->user->getId();
                    } else {
                        $table->data = $data;
                        $table->plan_id = $plan_id;
                        $table->type_session_id = $type_session_id;
                        $table->type_work_id = $type_work_id;

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
    }

    private function parse_dc_table(){
        $path = eval(Paths::$path_to_ПланыКомпетенции);
        $path1 = eval(Paths::$path_to_ПланыСтроки);

        foreach ($path as $p) {
            $comp = (string) $p['ШифрКомпетенции'];
            $comp_id = (tables\Comp::findOne(['index' => $comp]))->id;
            foreach ($path1 as $p1){
                $table = new tables\Dc();

                $disciplins = (string) $p1['ДисциплинаКод'];
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
        $this->parse_podpisants_table(); // 15
        $this->parse_comp_table(); // 16
        $this->parse_type_periods_table(); // 17
        $this->parse_period_table(); // 18
        $this->parse_comp_ps_has_comp_table(); // 19
        $this->parse_sprav_dis_table(); // 20
        $this->parse_kurs_table(); // 21
        $this->parse_plan_table(); // 22
        $this->parse_disciplins_table(); // 23
        $this->parse_type_form_table(); // 24
        $this->parse_form_table(); // 25
        $this->parse_kaf_has_comp_table(); // 26
        $this->parse_type_work_table(); // 27
        $this->parse_type_session_table(); // 28
        $this->parse_session_table(); // 29
        $this->parse_dc_table(); // 30

        $this->save_all($transaction);
    }
}
