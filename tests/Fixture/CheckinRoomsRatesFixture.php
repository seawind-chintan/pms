<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CheckinRoomsRatesFixture
 *
 */
class CheckinRoomsRatesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'checkin_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'room_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'room_rate_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'no_of_adult' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'no_of_child' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'checkin_id' => ['type' => 'index', 'columns' => ['checkin_id', 'room_id', 'room_rate_id'], 'length' => []],
            'room_id' => ['type' => 'index', 'columns' => ['room_id'], 'length' => []],
            'room_rate_id' => ['type' => 'index', 'columns' => ['room_rate_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'checkin_rooms_rates_ibfk_3' => ['type' => 'foreign', 'columns' => ['room_rate_id'], 'references' => ['room_rates', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'checkin_rooms_rates_ibfk_1' => ['type' => 'foreign', 'columns' => ['checkin_id'], 'references' => ['checkins', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'checkin_rooms_rates_ibfk_2' => ['type' => 'foreign', 'columns' => ['room_id'], 'references' => ['rooms', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'checkin_id' => 1,
            'room_id' => 1,
            'room_rate_id' => 1,
            'no_of_adult' => 1,
            'no_of_child' => 1
        ],
    ];
}
