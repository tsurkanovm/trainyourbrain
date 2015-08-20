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
        $this->createTable('{{%User}}', [
            'idUser' => Schema::TYPE_PK,
            'email' => Schema::TYPE_STRING . '(45) NOT NULL',
            'name' => Schema::TYPE_STRING . '(100) NOT NULL',
            'psw' => Schema::TYPE_STRING . '(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL',
            'gender' => ' enum(\'male\',\'female\') DEFAULT NULL',
            'role_idrole' => Schema::TYPE_SMALLINT . '(3) unsigned NOT NULL DEFAULT 1',
            'registration_data' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'photo' => Schema::TYPE_STRING . '(255) DEFAULT NULL'
        ], $tableOptions);

        $this->createIndex('ix_email', '{{%User}}', 'email', true);
        // ====================================================================================

        // ======== role ======================================================================
        $this->createTable('{{%role}}', [
            'idrole' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(20) NOT NULL'
        ], $tableOptions);

        $this->createIndex('ix_title', '{{%role}}', 'title', true);
        $this->addForeignKey('User_role_fk', 'User', 'role_idrole', 'role', 'idrole');
        // ====================================================================================

        // ======== test ======================================================================
        $this->createTable('{{%test}}', [
            'idTest' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(20) NOT NULL',
            'type' => ' enum(\'usual\',\'control\') DEFAULT NULL'
        ], $tableOptions);

        // $this->addPrimaryKey('idTest', '{{%test}}', 'idTest' );
        $this->createIndex('ix_title', '{{%test}}', 'title', true);
        // ====================================================================================

        // ======== result ====================================================================
        $this->createTable('{{%result}}', [
            'idResult' => Schema::TYPE_PK,
            'result' => Schema::TYPE_INTEGER . '(10) NOT NULL',
            'date_participate' => Schema::TYPE_DATE . ' NOT NULL',
            'idUser' => Schema::TYPE_INTEGER . '(10) unsigned NOT NULL',
            'idTest' => Schema::TYPE_SMALLINT . '(3) unsigned NOT NULL'
        ], $tableOptions);

        //    $this->addPrimaryKey('idResult', '{{%result}}', 'idResult' );
        $this->addForeignKey('fk_results_Users', 'User', 'idUser', 'result', 'idUser');
        $this->addForeignKey('fk_results_tests', 'test', 'idTest', 'result', 'idTest');
        // ====================================================================================


        // ======= insert the data ============================================================
        $role_array = ['idrole' => 1, 'title' => 'Basic'];
        $this->insert('{{%role}}', $role_array);
        $role_array = ['idrole' => 2, 'title' => 'Advance'];
        $this->insert('{{%role}}', $role_array);
        $role_array = ['idrole' => 3, 'title' => 'Admin'];
        $this->insert('{{%role}}', $role_array);

        $tests_array = ['title' => 'Math expressions', 'type' => 'usual'];
        $this->insert('{{%role}}', $tests_array);
        $tests_array = ['title' => 'Counting', 'type' => 'control'];
        $this->insert('{{%role}}', $tests_array);
        $tests_array = ['title' => 'Test Stuppa', 'type' => 'control'];
        $this->insert('{{%role}}', $tests_array);
        $tests_array = ['title' => 'Memory test', 'type' => 'control'];
        $this->insert('{{%role}}', $tests_array);

        $user_array = ['email' => 'test@test.com', 'name' => 'Admin',
            'psw' => '96e79218965eb72c92a549dd5a330112',
            'gender' => 'male', 'role_idrole' => 3];
        $this->insert('{{%User}}', $user_array);
        // ====================================================================================
    }

    public function down()
    {
        $this->dropTable('{{%User}}');
        $this->dropTable('{{%role}}');
        $this->dropTable('{{%test}}');
        $this->dropTable('{{%result}}');
    }
}
