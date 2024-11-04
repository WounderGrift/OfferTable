<?php

use yii\db\Migration;

/**
 * Class m241031_111333_insert_random_data_to_offers
 */
class m241031_111333_insert_random_data_to_offers extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%offers}}', ['title', 'email', 'phone'], [
            ['Offer 1', 'offer1@example.com', '1234567890'],
            ['Offer 2', 'offer2@example.com', '1234567891'],
            ['Offer 3', 'offer3@example.com', '1234567892'],
            ['Offer 4', 'offer4@example.com', '1234567893'],
            ['Offer 5', 'offer5@example.com', '1234567894'],
            ['Offer 6', 'offer6@example.com', null],
            ['Offer 7', 'offer7@example.com', '1234567896'],
            ['Offer 8', 'offer8@example.com', '1234567897'],
            ['Offer 9', 'offer9@example.com', null],
            ['Offer 10', 'offer10@example.com', '1234567899'],
            ['Offer 11', 'offer11@example.com', '1234567800'],
            ['Offer 12', 'offer12@example.com', null],
            ['Offer 13', 'offer13@example.com', '1234567802'],
            ['Offer 14', 'offer14@example.com', '1234567803'],
            ['Offer 15', 'offer15@example.com', '1234567804'],
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%offers}}');
    }
}
