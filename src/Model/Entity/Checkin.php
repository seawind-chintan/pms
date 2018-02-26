<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Checkin Entity
 *
 * @property int $id
 * @property int $member_id
 * @property \Cake\I18n\FrozenTime $arrival_date_time
 * @property int $no_of_adult
 * @property int $no_of_child
 * @property string $arrival_from
 * @property string $destination
 * @property string $purpose_of_visit
 * @property string $travel_agent
 * @property string $remarks
 * @property int $property_id
 * @property \Cake\I18n\FrozenTime $dept_date_time
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\Property $property
 * @property \App\Model\Entity\CheckinRoomsRate[] $checkin_rooms_rates
 */
class Checkin extends Entity
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
        'member_id' => true,
        'arrival_date_time' => true,
        'no_of_adult' => true,
        'no_of_child' => true,
        'arrival_from' => true,
        'destination' => true,
        'purpose_of_visit' => true,
        'travel_agent' => true,
        'remarks' => true,
        'property_id' => true,
        'dept_date_time' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'member' => true,
        'city' => true,
        'state' => true,
        'country' => true,
        'property' => true,
        'checkin_rooms_rates' => true
    ];
}
