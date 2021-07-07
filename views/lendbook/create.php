<?php

use app\models\Book;
use app\models\Employee;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lendbook */
/* @var $customer  app\models\Customer */

$this->title = 'Lend book for '.$customer->firstname.' '.$customer->secondname.' '.$customer->thirdname;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['//customer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lendbook-create">
    <h1><?= Html::encode($this->title) ?></h1>

<?php
    $form = ActiveForm::begin();
    $bookItems = ArrayHelper::map(Book::find()->all(),'id','title', 'author');
    $params = [
        'prompt' => 'Choose book from list above'
    ];
    echo $form->field($model, 'book_id')->dropDownList($bookItems,$params);


    $employeeItems = ArrayHelper::map(Employee::find()->all(),'id', function($employeeModel) {
        return $employeeModel['post'].': '.$employeeModel['firstname'].' '.$employeeModel['secondname'].' '.$employeeModel['thirdname'];
    });
    $params = [
        'prompt' => 'Choose Employee',
    ];
    echo $form->field($model, 'employee_id')->dropDownList($employeeItems,$params);


    echo $form->field($model, 'date_lending')->widget(\yii\jui\DatePicker::class, [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]);

    echo $form->field($model, 'date_expire_at')->widget(\yii\jui\DatePicker::class, [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Give', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    ActiveForm::end();
    ?>

</div>
