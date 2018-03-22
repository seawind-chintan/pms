<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WaterparkIssuedBeltsFixture
 *
 */
class WaterparkIssuedBeltsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'property_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ticket_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'belt_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'issued_date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'status' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '0:issued;1:closed;', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'property_id' => ['type' => 'index', 'columns' => ['property_id', 'ticket_id', 'belt_id'], 'length' => []],
            'ticket_id' => ['type' => 'index', 'columns' => ['ticket_id'], 'length' => []],
            'belt_id' => ['type' => 'index', 'columns' => ['belt_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'waterpark_issued_belts_ibfk_1' => ['type' => 'foreign', 'columns' => ['property_id'], 'references' => ['properties', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'waterpark_issued_belts_ibfk_2' => ['type' => 'foreign', 'columns' => ['ticket_id'], 'references' => ['waterpark_tickets', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'waterpark_issued_belts_ibfk_3' => ['type' => 'foreign', 'columns' => ['belt_id'], 'references' => ['waterpark_belts', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'property_id' => 1,
            'ticket_id' => 1,
            'belt_id' => 1,
            'issued_date' => '2018-03-22',
            'status' => 1,
            'created' => '2018-03-22 09:33:24',
            'modified' => '2018-03-22 09:33:24'
        ],
    ];
}
