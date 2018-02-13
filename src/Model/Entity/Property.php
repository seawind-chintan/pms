<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Property Entity
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $type
 * @property int $user
 * @property string $address
 * @property string $images
 * @property \Cake\I18n\FrozenTime $start_time
 * @property \Cake\I18n\FrozenTime $end_time
 * @property int $sunday_open
 * @property int $monday_open
 * @property int $tuesday_open
 * @property int $wednesday_open
 * @property int $thursday_open
 * @property int $friday_open
 * @property int $saturday_open
 * @property string $notes
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Property extends Entity
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
        'code' => true,
        'name' => true,
        'type' => true,
        'user' => true,
        'address' => true,
        'images' => true,
        'start_time' => true,
        'end_time' => true,
        'sunday_open' => true,
        'monday_open' => true,
        'tuesday_open' => true,
        'wednesday_open' => true,
        'thursday_open' => true,
        'friday_open' => true,
        'saturday_open' => true,
        'notes' => true,
        'status' => true,
        'created' => true,
        'modified' => true
    ];
}
