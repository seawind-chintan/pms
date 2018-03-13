<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WaterparkPrice Entity
 *
 * @property int $id
 * @property int $property_id
 * @property float $monday_total_price
 * @property float $monday_ticket_price
 * @property float $tuesday_total_price
 * @property float $tuesday_ticket_price
 * @property float $wednesday_total_price
 * @property float $wednesday_ticket_price
 * @property float $thursday_total_price
 * @property float $thursday_ticket_price
 * @property float $friday_total_price
 * @property float $friday_ticket_price
 * @property float $saturday_total_price
 * @property float $saturday_ticket_price
 * @property float $sunday_total_price
 * @property float $sunday_ticket_price
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Property $property
 */
class WaterparkPrice extends Entity
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
        'monday_total_price' => true,
        'monday_ticket_price' => true,
        'tuesday_total_price' => true,
        'tuesday_ticket_price' => true,
        'wednesday_total_price' => true,
        'wednesday_ticket_price' => true,
        'thursday_total_price' => true,
        'thursday_ticket_price' => true,
        'friday_total_price' => true,
        'friday_ticket_price' => true,
        'saturday_total_price' => true,
        'saturday_ticket_price' => true,
        'sunday_total_price' => true,
        'sunday_ticket_price' => true,
        'created' => true,
        'modified' => true,
        'property' => true
    ];
}
