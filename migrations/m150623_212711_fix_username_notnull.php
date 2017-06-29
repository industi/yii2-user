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

class m150623_212711_fix_username_notnull extends Migration
{
    private $userTN = 'usrUser';

    public function up()
    {

        $this->alterColumn($this->userTN, 'username', $this->string(255)->notNull());

    }

    public function down()
    {
        $this->alterColumn($this->userTN, 'username', $this->string(255)->null());
    }
}
