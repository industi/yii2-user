<?php

use yii\db\Query;
use dektrium\user\migrations\Migration;

class m150614_103145_update_social_account_table extends Migration
{
    private $socialAccountTN = 'usrSocialAccount';

    public function up()
    {
        $this->addColumn($this->socialAccountTN, 'code', $this->string(32)->null());
        $this->addColumn($this->socialAccountTN, 'created_at', $this->integer()->null());
        $this->addColumn($this->socialAccountTN, 'email', $this->string()->null());
        $this->addColumn($this->socialAccountTN, 'username', $this->string()->null());
        $this->createIndex('{{%account_unique_code}}', $this->socialAccountTN, 'code', true);

        $accounts = (new Query())->from($this->socialAccountTN)->select('id')->all($this->db);

        $transaction = $this->db->beginTransaction();
        try {
            foreach ($accounts as $account) {
                $this->db->createCommand()->update($this->socialAccountTN, [
                    'created_at' => time(),
                ], 'id = ' . $account['id'])->execute();
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    public function down()
    {
        $this->dropIndex('{{%account_unique_code}}', $this->socialAccountTN);
        $this->dropColumn($this->socialAccountTN, 'email');
        $this->dropColumn($this->socialAccountTN, 'username');
        $this->dropColumn($this->socialAccountTN, 'code');
        $this->dropColumn($this->socialAccountTN, 'created_at');
    }
}
