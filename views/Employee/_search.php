<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'secondname') ?>

    <?= $form->field($model, 'thirdname') ?>

    <?= $form->field($model, 'passport_series') ?>

    <?= $form->field($model, 'passport_code') ?>

    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'post') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
