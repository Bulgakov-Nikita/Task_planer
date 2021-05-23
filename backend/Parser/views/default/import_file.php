<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admin\Parser\models\Parser */

use yii\widgets\ActiveForm;

$this->title = 'Import xml';
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<button>Submit</button>

<?php ActiveForm::end() ?>
