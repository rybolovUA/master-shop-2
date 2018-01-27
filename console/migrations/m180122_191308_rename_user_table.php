<?php

use yii\db\Migration;

/**
 * Class m180122_191308_rename_user_table
 */
class m180122_191308_rename_user_table extends Migration
{
    public function up()
    {
        $this->renameTable('{{%user}}', '{{%users}}');
    }

    public function down()
    {
        $this->renameTable('{{%users}}', '{{%user}}');
    }
}
