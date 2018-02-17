<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ReservationRoomsFixture
 *
 */
class ReservationRoomsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'reservation_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'room_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'reservation_id' => ['type' => 'index', 'columns' => ['reservation_id', 'room_id'], 'length' => []],
            'reservation_id_2' => ['type' => 'index', 'columns' => ['reservation_id'], 'length' => []],
            'room_id' => ['type' => 'index', 'columns' => ['room_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'reservation_rooms_ibfk_2' => ['type' => 'foreign', 'columns' => ['room_id'], 'references' => ['rooms', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'reservation_rooms_ibfk_1' => ['type' => 'foreign', 'columns' => ['reservation_id'], 'references' => ['reservations', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'reservation_id' => 1,
            'room_id' => 1
        ],
    ];
}
