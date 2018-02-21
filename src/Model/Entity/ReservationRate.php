<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReservationRate Entity
 *
 * @property int $id
 * @property int $reservation_id
 * @property int $room_rate_id
 * @property int $no_of_adult
 * @property int $no_of_child
 * @property int $no_of_rooms
 *
 * @property \App\Model\Entity\Reservation $reservation
 * @property \App\Model\Entity\RoomRate $room_rate
 */
class ReservationRate extends Entity
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
        'reservation_id' => true,
        'room_rate_id' => true,
        'no_of_adult' => true,
        'no_of_child' => true,
        'no_of_rooms' => true,
        'reservation' => true,
        'room_rate' => true
    ];
}
