<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WaterparkSpecificPrice Entity
 *
 * @property int $id
 * @property int $property_id
 * @property int $type
 * @property \Cake\I18n\FrozenDate $single_date
 * @property \Cake\I18n\FrozenDate $from_date
 * @property \Cake\I18n\FrozenDate $to_date
 * @property float $total_price
 * @property float $ticket_price
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Property $property
 */
class WaterparkSpecificPrice extends Entity
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
        'type' => true,
        'single_date' => true,
        'from_date' => true,
        'to_date' => true,
        'total_price' => true,
        'ticket_price' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'property' => true
    ];
}
