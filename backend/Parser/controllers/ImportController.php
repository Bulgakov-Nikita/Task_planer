<?php

namespace app\modules\admin\Parser\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\Parser\models\Parser;
use yii\web\UploadedFile;

class ImportController extends Controller
{
    public function actionIndex()
    {
        $model = new Parser();
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->parse();
        } else {
            // если файл не выбран
            return $this->render('import_file', ['model' => $model]);
        }
    }
}