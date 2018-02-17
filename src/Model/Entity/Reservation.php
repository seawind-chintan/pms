<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reservation Entity
 *
 * @property int $id
 * @property string $member_type
 * @property int $member_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property int $city_id
 * @property int $state_id
 * @property int $country_id
 * @property string $pincode
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $reservation_type
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property int $no_of_adult
 * @property int $no_of_child
 * @property int $no_of_rooms
 * @property string $comments
 * @property float $rate
 * @property float $discount
 * @property float $total_cost
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\ReservationRoom[] $reservation_rooms
 */
class Reservation extends Entity
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
        'member_type' => true,
        'member_id' => true,
        'first_name' => true,
        'last_name' => true,
        'address' => true,
        'city_id' => true,
        'state_id' => true,
        'country_id' => true,
        'pincode' => true,
        'phone' => true,
        'mobile' => true,
        'email' => true,
        'property_id' => true,
        'reservation_type' => true,
        'start_date' => true,
        'end_date' => true,
        'no_of_adult' => true,
        'no_of_child' => true,
        'no_of_rooms' => true,
        'comments' => true,
        'rate' => true,
        'discount' => true,
        'total_cost' => true,
        'created' => true,
        'modified' => true,
        'member' => true,
        'city' => true,
        'state' => true,
        'country' => true,
        'reservation_rooms' => true
    ];
}
