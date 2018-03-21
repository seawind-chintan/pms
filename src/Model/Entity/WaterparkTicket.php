<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WaterparkTicket Entity
 *
 * @property int $id
 * @property int $property_id
 * @property int $user_id
 * @property string $code
 * @property int $no_of_persons
 * @property int $no_of_adults
 * @property int $no_of_childs
 * @property string $issued_by
 * @property int $member_id
 * @property string $member_type
 * @property float $total_amount
 * @property float $hold_amount
 * @property float $balance
 * @property string $discount_code
 * @property float $discount_amount
 * @property int $payment_mode
 * @property string $card_number
 * @property string $card_holder
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Property $property
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Member $member
 */
class WaterparkTicket extends Entity
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
        'user_id' => true,
        'code' => true,
        'no_of_persons' => true,
        'no_of_adults' => true,
        'no_of_childs' => true,
        'issued_by' => true,
        'member_id' => true,
        'member_type' => true,
        'mobileno' => true,
        'total_amount' => true,
        'hold_amount' => true,
        'balance' => true,
        'discount_code' => true,
        'discount_amount' => true,
        'net_amount' => true,
        'payment_mode' => true,
        'card_number' => true,
        'card_holder' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'property' => true,
        'user' => true,
        'member' => true
    ];
}
