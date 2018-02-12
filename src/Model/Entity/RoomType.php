<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RoomType Entity
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property float $price
 * @property int $total_rooms
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class RoomType extends Entity
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
        'name' => true,
        'slug' => true,
        'price' => true,
        'total_rooms' => true,
        'status' => true,
        'created' => true,
        'modified' => true
    ];
}
