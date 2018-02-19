<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RoomRatesFixture
 *
 */
class RoomRatesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'property_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'room_plan_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'room_type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'room_occupancy_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'rate' => ['type' => 'decimal', 'length' => 11, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'extra_charge' => ['type' => 'decimal', 'length' => 11, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => ''],
        'for_specific_dates' => ['type' => 'integer', 'length' => 2, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'from_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'to_date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'min_adult' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'max_adult' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'max_child' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'status' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'room_plan_id' => ['type' => 'index', 'columns' => ['room_plan_id', 'room_type_id', 'room_occupancy_id'], 'length' => []],
            'user_id' => ['type' => 'index', 'columns' => ['user_id', 'property_id'], 'length' => []],
            'property_id' => ['type' => 'index', 'columns' => ['property_id'], 'length' => []],
            'room_plan_id_2' => ['type' => 'index', 'columns' => ['room_plan_id'], 'length' => []],
            'room_type_id' => ['type' => 'index', 'columns' => ['room_type_id'], 'length' => []],
            'room_occupancy_id' => ['type' => 'index', 'columns' => ['room_occupancy_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'room_rates_ibfk_5' => ['type' => 'foreign', 'columns' => ['room_occupancy_id'], 'references' => ['room_occupancies', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'room_rates_ibfk_1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'room_rates_ibfk_2' => ['type' => 'foreign', 'columns' => ['property_id'], 'references' => ['properties', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'room_rates_ibfk_3' => ['type' => 'foreign', 'columns' => ['room_plan_id'], 'references' => ['room_plans', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'room_rates_ibfk_4' => ['type' => 'foreign', 'columns' => ['room_type_id'], 'references' => ['room_types', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'user_id' => 1,
            'property_id' => 1,
            'room_plan_id' => 1,
            'room_type_id' => 1,
            'room_occupancy_id' => 1,
            'rate' => 1.5,
            'extra_charge' => 1.5,
            'for_specific_dates' => 1,
            'from_date' => '2018-02-19',
            'to_date' => '2018-02-19',
            'min_adult' => 1,
            'max_adult' => 1,
            'max_child' => 1,
            'status' => 1,
            'created' => '2018-02-19 11:58:20',
            'modified' => '2018-02-19 11:58:20'
        ],
    ];
}
