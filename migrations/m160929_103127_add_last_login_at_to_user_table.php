<?php

namespace industi\yii2\user\migrations;

use industi\yii2\appengine\components\Migration;

class m160929_103127_add_last_login_at_to_user_table extends Migration
{
    private $userTN = 'usrUser';

    public function up()
    {
        $this->addColumn($this->userTN, 'last_login_at', $this->integer());
    }

    public function down()
    {
        $this->dropColumn($this->userTN, 'last_login_at');
    }
}
