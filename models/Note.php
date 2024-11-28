<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Note extends ActiveRecord
{
    // Указывает имя таблицы в базе данных
    public static function tableName()
    {
        return '{{%note}}';
    }

    // Правила валидации
    public function rules()
    {
        return [
            [['title', 'text'], 'required', 'message' => 'Это поле не может быть пустым'],
            [['title'], 'string', 'max' => 255, 'tooLong' => 'Заголовок не может быть длиннее 255 символов'],
            [['text'], 'string', 'min' => 10, 'tooShort' => 'Текст должен быть не короче 10 символов'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    // Метки для атрибутов (используются в формах)
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок идеи',
            'text' => 'Описание идеи',
        ];
    }

    // Выполняется перед сохранением записи
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Автоматически устанавливаем user_id текущего пользователя при создании
            if ($this->isNewRecord) {
                $this->user_id = Yii::$app->user->id;
            }
            return true;
        }
        return false;
    }

    // Связь с моделью User
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}