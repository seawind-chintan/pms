<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Room Entity
 *
 * @property int $id
 * @property string $number
 * @property string $code
 * @property int $type
 * @property string $description
 * @property string $images
 * @property string $images_dir
 * @property int $room_occupancy
 * @property int $user_id
 * @property int $property_id
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\RoomType $room_type
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Property $property
 */
class Room extends Entity
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
        'number' => true,
        'code' => true,
        'type' => true,
        'description' => true,
        'images' => true,
        'images_dir' => true,
        'room_occupancy' => true,
        'user_id' => true,
        'property_id' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'room_type' => true,
        'user' => true,
        'property' => true
    ];
}
