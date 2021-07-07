<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lendbook */
/* @var $form yii\widgets\ActiveForm */

$style= <<< CSS
   #employee-selector {
   display: flex;
   flex-direction: column;
   }
CSS;
?>

<div class="lendbook-form">

    <?php $form = ActiveForm::begin([
        'id' => 'employee-selector',

    ]); ?>

    <?= $form->field($model, 'book_id')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'employee_id')->textInput() ?>

    <?= $form->field($model, 'date_lending')->widget(\yii\jui\DatePicker::class, [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'date_expire_at')->widget(\yii\jui\DatePicker::class, [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
