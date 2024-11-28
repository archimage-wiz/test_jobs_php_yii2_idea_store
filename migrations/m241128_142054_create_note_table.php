<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%note}}`.
 */
class m241128_142054_create_note_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%note}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        // Создаем индекс для внешнего ключа
        $this->createIndex(
            'idx-note-user_id',
            '{{%note}}',
            'user_id'
        );

        // Добавляем внешний ключ к таблице пользователей
        $this->addForeignKey(
            'fk-note-user_id',
            '{{%note}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Удаляем внешний ключ
        $this->dropForeignKey(
            'fk-note-user_id',
            '{{%note}}'
        );

        // Удаляем индекс
        $this->dropIndex(
            'idx-note-user_id',
            '{{%note}}'
        );

        // Удаляем таблицу
        $this->dropTable('{{%note}}');
    }
}