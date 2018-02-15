<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserDetail Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property int $city
 * @property int $state
 * @property int $country
 * @property string $pincode
 * @property string $address
 * @property string $profile_pic
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class UserDetail extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'city' => true,
        'state' => true,
        'country' => true,
        'pincode' => true,
        'address' => true,
        'profile_pic' => true,
        'created' => true,
        'modified' => true,
        'user' => true
    ];
}
