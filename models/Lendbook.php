<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lendbook".
 *
 * @property int $id
 * @property int $book_id
 * @property int $customer_id
 * @property int $employee_id
 * @property string $date_lending
 * @property string $date_expire_at
 * @property string|null $date_actual_return
 * @property int|null $condition_arrived
 */
class Lendbook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lendbook';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'customer_id', 'employee_id', 'date_lending', 'date_expire_at'], 'required'],
            [['book_id', 'customer_id', 'employee_id', 'condition_arrived'], 'default', 'value' => null],
            [['book_id', 'customer_id', 'employee_id', 'condition_arrived'], 'integer'],
            [['date_lending', 'date_expire_at', 'date_actual_return'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'customer_id' => 'Customer ID',
            'employee_id' => 'Employee ID',
            'date_lending' => 'Date Lending',
            'date_expire_at' => 'Date Expire At',
            'date_actual_return' => 'Date Actual Return',
            'condition_arrived' => 'Condition Arrived',
        ];
    }
}
