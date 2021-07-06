<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\bootstrap\ActiveForm */

$style= <<< CSS
   #employee-selector {
   display: flex;
   flex-direction: column;
   }
CSS;
$this->registerCss($style);
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin([
        'id' => 'employee-selector',
        'fieldConfig' => [
            'template' => "<div class=''>{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div></div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label']
            ]
    ]); ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'secondname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thirdname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport_series')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
