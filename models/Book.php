<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;

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
            [['title', 'author', 'vendor_code', 'date_arrived'], 'required'],
            [['date_arrived'], 'safe', ],
            [['date_arrived'], 'date', 'format' => 'php:Y-m-d'],
            [['available'], 'boolean'],
            [['available'], 'default', 'value' => true],
            [['condition'], 'default', 'value' => 100],
            [['condition'], 'integer', 'max' => 100, 'min' => 0],
            [['title', 'author'], 'string', 'max' => 50],
            [['vendor_code'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public static function findAvailableBooks($available = true) {
        return Book::findAll(['available' => $available]);
    }

    public static function ReserveBook($id, $reserve = true) {
        $book = Book::findOne(['id' => $id]);
        if (isset($book)) {
            $book->available = !$reserve;
        }
        return ($book->save());
    }

    public static function getBook($id) {
        $book = Book::findOne(['id' => $id]);
        if (isset($book)) {
            return $book;
        }
        throw new NotFoundHttpException('Book not found');
    }

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
