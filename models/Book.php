<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string $vendor_code
 * @property string $date_arrived
 * @property bool $available
 * @property int $condition
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'author', 'vendor_code', 'date_arrived', 'available'], 'required'],
            [['date_arrived'], 'safe'],
            [['available'], 'boolean'],
            [['condition'], 'default', 'value' => null],
            [['condition'], 'integer'],
            [['title', 'author'], 'string', 'max' => 50],
            [['vendor_code'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'author' => 'Author',
            'vendor_code' => 'Vendor Code',
            'date_arrived' => 'Date Arrived',
            'available' => 'Available',
            'condition' => 'Condition',
        ];
    }
}
