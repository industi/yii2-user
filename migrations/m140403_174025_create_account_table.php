<?php

namespace industi\yii2\user\migrations;

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use industi\yii2\appengine\components\Migration;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */
class m140403_174025_create_account_table extends Migration
{
    private $userTN = 'usrUser';
    private $accountTN = 'usrAccount';

    public function up()
    {
        $this->createTable($this->accountTN, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->null(),
            'provider' => $this->string()->notNull(),
            'client_id' => $this->string()->notNull(),
            'properties' => $this->text()->null(),
        ], $this->tableOptions);

        $this->createIndex('{{%account_unique}}', $this->accountTN, ['provider', 'client_id'], true);
        $this->createFkIdx($this->accountTN, 'user_id', $this->userTN, 'id');
    }

    public function down()
    {
        $this->dropTable($this->accountTN);
    }
}
