<?php

namespace industi\yii2\user\migrations;

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use industi\yii2\appengine\components\Migration;

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
        $this->createFkIdx($this->tokenTN, 'user_id', $this->userTN, 'id');
    }

    public function down()
    {
        $this->dropTable($this->tokenTN);
    }
}
