<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WaterparkIssuedBelt Entity
 *
 * @property int $id
 * @property int $property_id
 * @property int $ticket_id
 * @property int $belt_id
 * @property \Cake\I18n\FrozenDate $issued_date
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Property $property
 * @property \App\Model\Entity\WaterparkTicket $waterpark_ticket
 * @property \App\Model\Entity\WaterparkBelt $waterpark_belt
 */
class WaterparkIssuedBelt extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'property_id' => true,
        'ticket_id' => true,
        'belt_id' => true,
        'issued_date' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'property' => true,
        'waterpark_ticket' => true,
        'waterpark_belt' => true
    ];
}
