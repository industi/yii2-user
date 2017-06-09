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

class m150623_212711_fix_username_notnull extends Migration
{
    private $userTN = 'usrUser';

    public function up()
    {
        if ($this->dbType == 'pgsql') {
            $this->alterColumn($this->userTN, 'username', 'SET NOT NULL');
        } else {
            if ($this->dbType == 'sqlsrv') {
                $this->dropIndex('{{%user_unique_username}}', $this->userTN);
            }
            $this->alterColumn($this->userTN, 'username', $this->string(255)->notNull());
            if ($this->dbType == 'sqlsrv') {
                $this->createIndex('{{%user_unique_username}}', $this->userTN, 'username', true);
            }
        }
    }

    public function down()
    {
        if ($this->dbType == "pgsql") {
            $this->alterColumn($this->userTN, 'username', 'DROP NOT NULL');
        } else {
            if ($this->dbType == 'sqlsrv') {
                $this->dropIndex('{{%user_unique_username}}', $this->userTN);
            }
            $this->alterColumn($this->userTN, 'username', $this->string(255)->null());
            if ($this->dbType == 'sqlsrv') {
                $this->createIndex('{{%user_unique_username}}', $this->userTN, 'username', true);
            }
        }
    }
}
