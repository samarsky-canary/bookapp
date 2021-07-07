<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $dataProvider yii\data\SqlDataProvider */


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'firstname',
            'secondname',
            'thirdname',
            'passport_series',
            'passport_code',
            'id',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['class' => yii\grid\DataColumn::class,
                'label' => 'Book',
                'value' => function($model, $key) {
                    $book = \app\models\Book::getBook($key);
                    return $book->title.':. '.$book->author;
                }
                ],
            'date_lending',
            'date_expire_at',
            'date_actual_return',
            'condition_arrived',
        ],
    ]); ?>


</div>
