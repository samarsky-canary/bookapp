<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $books app\models\Book */
/* @var $employees app\models\Employee */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Give Book Form';
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <h5><?= Html::encode($model->firstname)?> <?= Html::encode($model->secondname)?> <?= Html::encode($model->thirdname)?></h5>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'passport_series',
            'passport_code',
        ],
    ]) ?>

    <?php
        $form = ActiveForm::begin();
        $items = ArrayHelper::map($books,'id','title', 'author');
        $params = [
            'prompt' => 'Choose book from list above'
        ];
        $bookModel =new \app\models\Book();
    echo $form->field($bookModel, 'title')->dropDownList($items,$params);
        ActiveForm::end();
    ?>

    <?php
    $form = ActiveForm::begin();
    $items = ArrayHelper::map($employees,'id', function($employeeModel) {
        return $employeeModel['post'].': '.$employeeModel['firstname'].' '.$employeeModel['secondname'].' '.$employeeModel['thirdname'];
    });
    $params = [
        'prompt' => 'Choose Employee',
    ];
    $employeeModel =new \app\models\Employee();
    echo $form->field($employeeModel, 'firstname')->dropDownList($items,$params);

    ActiveForm::end();
    ?>



</div>
