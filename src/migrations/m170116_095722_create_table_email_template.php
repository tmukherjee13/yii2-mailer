<?php

use yii\db\Migration;

class m170116_095722_create_table_email_template extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%email_template}}', [

            'id'      => $this->primaryKey()->unsigned()->notNull(),
            'code'    => $this->string(255)->notNull(),
            'subject' => $this->string(255),
            'body'    => $this->text(),
            'status'  => $this->boolean()->defaultValue(1),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime(),

        ]);

        $this->createIndex('idx_email_templates_code', '{{%email_template}}', 'code', true);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('idx_email_templates_code', '{{%email_template}}');
        $this->dropTable('{{%email_template}}');
    }
}
