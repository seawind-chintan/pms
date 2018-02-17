<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReservationRoom Entity
 *
 * @property int $id
 * @property int $reservation_id
 * @property int $room_id
 *
 * @property \App\Model\Entity\Reservation $reservation
 * @property \App\Model\Entity\Room $room
 */
class ReservationRoom extends Entity
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
        'room_id' => true,
        'reservation' => true,
        'room' => true
    ];
}
