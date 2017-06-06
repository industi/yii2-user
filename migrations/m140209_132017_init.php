<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use dektrium\user\migrations\Migration;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class m140209_132017_init extends Migration
{
    private $userTN = 'usrUser';
    private $profileTN = 'usrProfile';

    public function up()
    {
        $this->createTable($this->userTN, [
            'id'                   => $this->primaryKey(),
            'username'             => $this->string(25)->notNull(),
            'email'                => $this->string(255)->notNull(),
            'password_hash'        => $this->string(60)->notNull(),
            'auth_key'             => $this->string(32)->notNull(),
            'confirmation_token'   => $this->string(32)->null(),
            'confirmation_sent_at' => $this->integer()->null(),
            'confirmed_at'         => $this->integer()->null(),
            'unconfirmed_email'    => $this->string(255)->null(),
            'recovery_token'       => $this->string(32)->null(),
            'recovery_sent_at'     => $this->integer()->null(),
            'blocked_at'           => $this->integer()->null(),
            'registered_from'      => $this->integer()->null(),
            'logged_in_from'       => $this->integer()->null(),
            'logged_in_at'         => $this->integer()->null(),
            'created_at'           => $this->integer()->notNull(),
            'updated_at'           => $this->integer()->notNull(),
        ], $this->tableOptions);

        $this->createIndex('{{%user_unique_username}}', $this->userTN, 'username', true);
        $this->createIndex('{{%user_unique_email}}', $this->userTN, 'email', true);
        $this->createIndex('{{%user_confirmation}}', $this->userTN, 'id, confirmation_token', true);
        $this->createIndex('{{%user_recovery}}', $this->userTN, 'id, recovery_token', true);

        $this->createTable($this->profileTN, [
            'user_id'        => $this->integer()->notNull()->append('PRIMARY KEY'),
            'name'           => $this->string(255)->null(),
            'public_email'   => $this->string(255)->null(),
            'gravatar_email' => $this->string(255)->null(),
            'gravatar_id'    => $this->string(32)->null(),
            'location'       => $this->string(255)->null(),
            'website'        => $this->string(255)->null(),
            'bio'            => $this->text()->null(),
        ], $this->tableOptions);

        $this->addForeignKey('{{%fk_user_profile}}', $this->profileTN, 'user_id', $this->userTN, 'id', $this->cascade, $this->restrict);
    }

    public function down()
    {
        $this->dropTable($this->profileTN);
        $this->dropTable($this->userTN);
    }
}
