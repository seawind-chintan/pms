<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WaterparkKotItem Entity
 *
 * @property int $id
 * @property int $property_id
 * @property int $waterpark_kot_id
 * @property int $waterpark_kot_no
 * @property int $restaurant_kitchen_id
 * @property int $restaurant_menu_id
 * @property string $menu_code
 * @property string $menu_name
 * @property float $price
 * @property int $qty
 * @property float $total_price
 * @property \Cake\I18n\FrozenDate $kot_item_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Property $property
 * @property \App\Model\Entity\WaterparkKot $waterpark_kot
 * @property \App\Model\Entity\RestaurantKitchen $restaurant_kitchen
 * @property \App\Model\Entity\RestaurantMenu $restaurant_menu
 */
class WaterparkKotItem extends Entity
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
        'waterpark_kot_id' => true,
        'waterpark_kot_no' => true,
        'restaurant_kitchen_id' => true,
        'restaurant_menu_id' => true,
        'menu_code' => true,
        'menu_name' => true,
        'price' => true,
        'qty' => true,
        'total_price' => true,
        'kot_item_date' => true,
        'created' => true,
        'modified' => true,
        'property' => true,
        'waterpark_kot' => true,
        'restaurant_kitchen' => true,
        'restaurant_menu' => true,
        'restaurant_menu_type_id' => true
    ];
}
