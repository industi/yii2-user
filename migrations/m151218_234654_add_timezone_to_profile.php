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

class m151218_234654_add_timezone_to_profile extends Migration
{
    private $profileTN = 'usrProfile';

    public function up()
    {
        $this->addColumn($this->profileTN, 'timezone', $this->string(40)->null());
    }

    public function down()
    {
        $this->dropcolumn($this->profileTN, 'timezone');
    }
}
