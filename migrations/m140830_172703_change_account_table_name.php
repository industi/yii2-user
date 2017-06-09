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

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class m140830_172703_change_account_table_name extends Migration
{
    private $accountTN = 'usrAccount';
    private $socialAccountTN = 'usrSocialAccount';

    public function up()
    {
        $this->renameTable($this->accountTN, $this->socialAccountTN);
    }

    public function down()
    {
        $this->renameTable($this->socialAccountTN, $this->accountTN);
    }
}
