<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RestaurantMenu Entity
 *
 * @property int $id
 * @property int $property_id
 * @property int $restaurant_kitchen_id
 * @property int $restaurant_menu_type_id
 * @property string $menu_category
 * @property string $code
 * @property string $name
 * @property float $price
 * @property string $description
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Property $property
 * @property \App\Model\Entity\RestaurantKitchen $restaurant_kitchen
 * @property \App\Model\Entity\RestaurantMenuType $restaurant_menu_type
 */
class RestaurantMenu extends Entity
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
        'restaurant_kitchen_id' => true,
        'restaurant_menu_type_id' => true,
        'menu_category' => true,
        'code' => true,
        'name' => true,
        'price' => true,
        'description' => true,
        'discountable' => true,
        'is_home_delivery' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'property' => true,
        'restaurant_kitchen' => true,
        'restaurant_menu_type' => true
    ];
}
