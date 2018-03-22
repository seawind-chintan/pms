<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RestaurantTableBooking Entity
 *
 * @property int $id
 * @property int $property_id
 * @property string $restaurant_table_ids
 * @property \Cake\I18n\FrozenDate $booking_date
 * @property \Cake\I18n\FrozenTime $booking_time
 * @property string $name
 * @property string $book_by
 * @property string $email
 * @property string $address
 * @property string $mobile
 * @property int $no_of_pax
 * @property string $remarks
 * @property int $booking_status
 * @property float $advanced_payment
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class RestaurantTableBooking extends Entity
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
        'restaurant_table_ids' => true,
        'booking_date' => true,
        'booking_time' => true,
        'name' => true,
        'book_by' => true,
        'email' => true,
        'address' => true,
        'mobile' => true,
        'no_of_pax' => true,
        'remarks' => true,
        'booking_status' => true,
        'advanced_payment' => true,
        'status' => true,
        'created' => true,
        'modified' => true
    ];
}
