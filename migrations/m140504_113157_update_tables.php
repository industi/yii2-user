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
class m140504_113157_update_tables extends Migration
{
    private $userTN = 'usrUser';
    private $accountTN = 'usrAccount';

    public function up()
    {
        // user table
        $this->dropIndex('{{%user_confirmation}}', $this->userTN);
        $this->dropIndex('{{%user_recovery}}', $this->userTN);
        $this->dropColumn($this->userTN, 'confirmation_token');
        $this->dropColumn($this->userTN, 'confirmation_sent_at');
        $this->dropColumn($this->userTN, 'recovery_token');
        $this->dropColumn($this->userTN, 'recovery_sent_at');
        $this->dropColumn($this->userTN, 'logged_in_from');
        $this->dropColumn($this->userTN, 'logged_in_at');
        $this->renameColumn($this->userTN, 'registered_from', 'registration_ip');
        $this->addColumn($this->userTN, 'flags', $this->integer()->notNull()->defaultValue(0));

        // account table
        $this->renameColumn($this->accountTN, 'properties', 'data');
    }

    public function down()
    {
        // account table
        $this->renameColumn($this->accountTN, 'data', 'properties');

        $this->dropColumn($this->userTN, 'flags');
        $this->renameColumn($this->userTN, 'registration_ip', 'registered_from');
        $this->addColumn($this->userTN, 'logged_in_at', $this->integer());
        $this->addColumn($this->userTN, 'logged_in_from', $this->integer());
        $this->addColumn($this->userTN, 'recovery_sent_at', $this->integer());
        $this->addColumn($this->userTN, 'recovery_token', $this->string(32));
        $this->addColumn($this->userTN, 'confirmation_sent_at', $this->integer());
        $this->addColumn($this->userTN, 'confirmation_token', $this->string(32));
        $this->createIndex('{{%user_confirmation}}', $this->userTN, 'id, confirmation_token', true);
        $this->createIndex('{{%user_recovery}', $this->userTN, 'id, recovery_token', true);
    }
}
