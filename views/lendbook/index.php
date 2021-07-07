<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Borrowed books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lendbook-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['class' => yii\grid\DataColumn::class,
                'label' => 'Book',
                'value' => function($model, $key) {
                    $book = \app\models\Book::getBook($model->book_id);
                    return $book->title.':. '.$book->author;
                }
            ],
            'date_lending',
            'date_expire_at',
            'date_actual_return',
            'condition_arrived',

            ['class' => yii\grid\ActionColumn::class,
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',['lendbook/update', 'id'=>$model->id], [
                            'title' => Yii::t('app', 'Add Book'),
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
