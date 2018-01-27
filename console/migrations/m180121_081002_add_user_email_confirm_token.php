<?php

use yii\db\Migration;

class m180121_081002_add_user_email_confirm_token extends Migration
{
    public function up()
    {
        $this->addColumn('{{%User}}', 'email_confirm_token', $this->string()->unique()->after('email'));
    }

    public function down()
    {
        $this->dropColumn('{{%User}}', 'email_confirm_token');
    }
}