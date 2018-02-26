<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CheckinRoomsRate Entity
 *
 * @property int $id
 * @property int $checkin_id
 * @property int $room_id
 * @property int $room_rate_id
 * @property int $no_of_adult
 * @property int $no_of_child
 *
 * @property \App\Model\Entity\Checkin $checkin
 * @property \App\Model\Entity\Room $room
 * @property \App\Model\Entity\RoomRate $room_rate
 */
class CheckinRoomsRate extends Entity
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
        'checkin_id' => true,
        'room_id' => true,
        'room_rate_id' => true,
        'no_of_adult' => true,
        'no_of_child' => true,
        'checkin' => true,
        'room' => true,
        'room_rate' => true
    ];
}
