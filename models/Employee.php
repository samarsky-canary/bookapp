<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property string $firstname
 * @property string $secondname
 * @property string|null $thirdname
 * @property string $passport_series
 * @property string $passport_code
 * @property int $id
 * @property string $post
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'secondname', 'passport_series', 'passport_code', 'post'], 'required'],
            [['firstname', 'secondname', 'thirdname'], 'string', 'max' => 50],
            [['passport_series'], 'string', 'max' => 4],
            [['passport_code'], 'string', 'max' => 6],
            [['passport_code'],  'match', 'pattern'=>'/^[0-9]+$/u', 'message' => 'Only numbers allowed'],
            [['passport_series'],  'match', 'pattern'=>'/^[0-9]+$/u', 'message' => 'Only numbers allowed'],
            [['post'], 'string', 'max' => 30],
        ];
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
            'post' => 'Post',
        ];
    }
}
