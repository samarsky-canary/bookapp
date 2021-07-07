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

    <?= $form->field($model, 'date_actual_return')->widget(\yii\jui\DatePicker::class, [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'condition_arrived')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
