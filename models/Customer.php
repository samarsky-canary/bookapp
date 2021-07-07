<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property string $firstname
 * @property string $secondname
 * @property string|null $thirdname
 * @property string $passport_series
 * @property string $passport_code
 * @property int $id
 */
class Customer extends \yii\db\ActiveRecord
{
    public $has_books = false;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'secondname', 'passport_series', 'passport_code'], 'required'],
            [['firstname', 'secondname', 'thirdname'], 'string', 'max' => 50],
            [['passport_series'], 'string', 'max' => 4],
            [['passport_code'], 'string', 'max' => 6],
            [['passport_code'],  'match', 'pattern'=>'/^[0-9]+$/u', 'message' => 'Only numbers allowed'],
            [['passport_series'],  'match', 'pattern'=>'/^[0-9]+$/u', 'message' => 'Only numbers allowed'],
            [['has_books'], 'boolean']
        ];
    }

    public static function getBooks($id) {
        return Customer::find()->select('id')
            ->from('lendbook')
            ->where(['customer_id' =>$id])->all();
    }

    public static  function  isLentBooks($id) {
        return Customer::getBooks($id) !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'firstname' => 'Firstname',
            'secondname' => 'Secondname',
            'thirdname' => 'Thirdname',
            'passport_series' => 'Passport Series',
            'passport_code' => 'Passport Code',
            'id' => 'ID',
            'has_books' => 'Has books'
        ];
    }
}
