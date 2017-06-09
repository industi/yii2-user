<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use industi\yii2\appengine\components\Migration;

class m141222_135246_alter_username_length extends Migration
{
    private $userTN = 'usrUser';

    public function up()
    {
        if ($this->dbType == 'sqlsrv') {
            $this->dropIndex('{{%user_unique_username}}', $this->userTN);
        }
        if ($this->dbType == 'pgsql') {
            $this->alterColumn($this->userTN, 'username', 'SET NOT NULL');
        } else {
            $this->alterColumn($this->userTN, 'username', $this->string(255)->notNull());
        }
        if ($this->dbType == 'sqlsrv') {
            $this->createIndex('{{%user_unique_username}}', $this->userTN, 'username', true);
        }
    }

    public function down()
    {
        if ($this->dbType == 'sqlsrv') {
            $this->dropIndex('{{%user_unique_username}}', $this->userTN);
        }
        if ($this->dbType == 'pgsql') {
            $this->alterColumn($this->userTN, 'username', 'DROP NOT NULL');
        } else {
            $this->alterColumn($this->userTN, 'username', $this->string(255)->notNull());
        }
        if ($this->dbType == 'sqlsrv') {
            $this->createIndex('{{%user_unique_username}}', $this->userTN, 'username', true);
        }
    }
}
