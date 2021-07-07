<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'firstname',
            'secondname',
            'thirdname',
            'passport_series',
            'passport_code',
            //'id',

            ['class' => yii\grid\ActionColumn::class,
                'template' => '{add}{return}{view}{delete}{update}',
                'buttons' => [
                    'add' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>',['lendbook/create', 'id'=>$model->id], [
                            'title' => Yii::t('app', 'Add Book'),
                        ]);
                    },
                    'return' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-minus"></span>', 'customer/delete?id='.$model->id, [
                            'title' => Yii::t('app', 'Return Book'),
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>

</div>
