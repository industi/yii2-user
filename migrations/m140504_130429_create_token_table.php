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
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class m140504_130429_create_token_table extends Migration
{
    private $tokenTN = 'usrToken';
    private $userTN = 'usrUser';

    public function up()
    {
        $this->createTable($this->tokenTN, [
            'user_id'    => $this->integer()->notNull(),
            'code'       => $this->string(32)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'type'       => $this->smallInteger()->notNull(),
        ], $this->tableOptions);

        $this->createIndex('{{%token_unique}}', $this->tokenTN, ['user_id', 'code', 'type'], true);
        $this->addForeignKey('{{%fk_user_token}}', $this->tokenTN, 'user_id', $this->userTN, 'id', $this->cascade, $this->restrict);
    }

    public function down()
    {
        $this->dropTable($this->tokenTN);
    }
}
