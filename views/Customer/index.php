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

            ['class' => \yii\grid\DataColumn::class,
                'label' => 'Has Books',
                'format' => 'boolean',
                'value' => function($model) {
                    return \app\models\Customer::find()
                        ->select('id')
                        ->from('lendbook')
                        ->where(['customer_id' => $model->id])
                        ->limit(1)->one() !== null;
                },
            ],
            ['class' => yii\grid\ActionColumn::class,
                'template' => '{give}{view}{delete}{update}',
                'buttons' => [
                    'give' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-upload"></span>',['lendbook/create', 'id'=>$model->id], [
                            'title' => Yii::t('app', 'Add Book'),
                        ]);
                    },
                    'return' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-download"></span>', 'customer/delete?id='.$model->id, [
                            'title' => Yii::t('app', 'Return Book'),
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>

    <?= Html::a('Return Book',  'index.php?r=lendbook%2Findex', ['class' => 'btn btn-primary']) ?>


</div>
