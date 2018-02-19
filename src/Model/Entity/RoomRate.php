<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RoomRate Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $property_id
 * @property int $room_plan_id
 * @property int $room_type_id
 * @property int $room_occupancy_id
 * @property float $rate
 * @property float $extra_charge
 * @property int $for_specific_dates
 * @property \Cake\I18n\FrozenDate $from_date
 * @property \Cake\I18n\FrozenDate $to_date
 * @property int $min_adult
 * @property int $max_adult
 * @property int $max_child
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Property $property
 * @property \App\Model\Entity\RoomPlan $room_plan
 * @property \App\Model\Entity\RoomType $room_type
 * @property \App\Model\Entity\RoomOccupancy $room_occupancy
 */
class RoomRate extends Entity
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
        'user_id' => true,
        'property_id' => true,
        'room_plan_id' => true,
        'room_type_id' => true,
        'room_occupancy_id' => true,
        'rate' => true,
        'extra_charge' => true,
        'for_specific_dates' => true,
        'from_date' => true,
        'to_date' => true,
        'min_adult' => true,
        'max_adult' => true,
        'max_child' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'property' => true,
        'room_plan' => true,
        'room_type' => true,
        'room_occupancy' => true
    ];
}
