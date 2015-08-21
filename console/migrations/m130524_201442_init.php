<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // ======== User ====================================================================
        $this->createTable('{{%user}}', [
            'userid' => Schema::TYPE_PK . ' AUTO_INCREMENT',
            'email' => Schema::TYPE_STRING . '(45) NOT NULL',
            'name' => Schema::TYPE_STRING . '(100) NOT NULL',
            'psw' => Schema::TYPE_STRING . '(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL',
            'gender' => ' enum(\'male\',\'female\') DEFAULT NULL',
            'roleid' => Schema::TYPE_SMALLINT . '(3) unsigned NOT NULL DEFAULT 1',
            'registration_data' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'photo' => Schema::TYPE_STRING . '(255) DEFAULT NULL'
        ], $tableOptions);

        //$this->addPrimaryKey('userid', '{{%user}}', 'userid' );
        $this->createIndex('ix_email', '{{%user}}', 'email', true);
        // ====================================================================================

        // ======== role ======================================================================
        $this->createTable('{{%role}}', [
            'roleid' => Schema::TYPE_SMALLINT . '(3) unsigned NOT NULL',
            'title' => Schema::TYPE_STRING . '(20) NOT NULL'
        ], $tableOptions);

        $this->addPrimaryKey('roleid', '{{%role}}', 'roleid' );
        $this->createIndex('ix_title', '{{%role}}', 'title', true);
        $this->addForeignKey('user_role_fk', '{{%user}}', 'roleid', '{{%role}}', 'roleid');
        // ====================================================================================

        // ======== test ======================================================================
        $this->createTable('{{%test}}', [
            'testid' => Schema::TYPE_SMALLINT . '(3) unsigned NOT NULL',
            'title' => Schema::TYPE_STRING . '(20) NOT NULL',
            'type' => ' enum(\'usual\',\'control\') DEFAULT NULL'
        ], $tableOptions);

        $this->addPrimaryKey('testid', '{{%test}}', 'testid' );
        $this->createIndex('ix_title', '{{%test}}', 'title', true);
        // ====================================================================================

        // ======== result ====================================================================
        $this->createTable('{{%result}}', [
            'resultid' => Schema::TYPE_PK . ' AUTO_INCREMENT',
            'result' => Schema::TYPE_INTEGER . '(10) NOT NULL',
            'date_participate' => Schema::TYPE_DATE . ' NOT NULL',
            'userid' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'testid' => Schema::TYPE_SMALLINT . '(3) unsigned NOT NULL'
        ], $tableOptions);

        //    $this->addPrimaryKey('idResult', '{{%result}}', 'idResult' );
        $this->addForeignKey('result_user_fk', '{{%result}}', 'userid', '{{%user}}', 'userid');
        $this->addForeignKey('result_test_fk', '{{%result}}', 'testid', '{{%test}}', 'testid');
        // ====================================================================================


        // ======= insert the data ============================================================
        $role_array = ['roleid' => 1, 'title' => 'Basic'];
        $this->insert('{{%role}}', $role_array);
        $role_array = ['roleid' => 2, 'title' => 'Advance'];
        $this->insert('{{%role}}', $role_array);
        $role_array = ['roleid' => 3, 'title' => 'Admin'];
        $this->insert('{{%role}}', $role_array);

        $tests_array = ['testid' => 1 , 'title' => 'Math expressions', 'type' => 'usual'];
        $this->insert('{{%test}}', $tests_array);
        $tests_array = ['testid' => 2 , 'title' => 'Counting', 'type' => 'control'];
        $this->insert('{{%test}}', $tests_array);
        $tests_array = ['testid' => 3 , 'title' => 'Test Stuppa', 'type' => 'control'];
        $this->insert('{{%test}}', $tests_array);
        $tests_array = ['testid' => 4 , 'title' => 'Memory test', 'type' => 'control'];
        $this->insert('{{%test}}', $tests_array);

        $user_array = ['email' => 'test@test.com', 'name' => 'Admin',
            'psw' => '96e79218965eb72c92a549dd5a330112',
            'gender' => 'male', 'roleid' => 3];
        $this->insert('{{%user}}', $user_array);
        // ====================================================================================
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%role}}');
        $this->dropTable('{{%test}}');
        $this->dropTable('{{%result}}');
    }
}
