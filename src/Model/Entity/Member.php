<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Member Entity
 *
 * @property int $id
 * @property int $package_id
 * @property string $member_type
 * @property string $code
 * @property string $first_name
 * @property string $last_name
 * @property string $nick_name
 * @property string $application_no
 * @property int $member_group_id
 * @property string $occupation
 * @property string $organization
 * @property string $designation
 * @property \Cake\I18n\FrozenDate $birth_date
 * @property \Cake\I18n\FrozenDate $anniversary_date
 * @property string $blood_group
 * @property string $pancard
 * @property string $aadharcard
 * @property string $remark
 * @property string $gender
 * @property string $marrital_status
 * @property string $cor_address
 * @property string $cor_city
 * @property string $cor_state
 * @property string $cor_country
 * @property string $cor_pincode
 * @property string $res_address
 * @property string $res_city
 * @property string $res_state
 * @property string $res_country
 * @property string $res_pincode
 * @property string $email
 * @property string $phone
 * @property string $mobile
 * @property $images
 * @property string $images_dir
 * @property string $services
 * @property int $discount
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Package $package
 * @property \App\Model\Entity\MemberGroup $member_group
 */
class Member extends Entity
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
        'package_id' => true,
        'member_type' => true,
        'code' => true,
        'first_name' => true,
        'last_name' => true,
        'nick_name' => true,
        'application_no' => true,
        'member_group_id' => true,
        'occupation' => true,
        'organization' => true,
        'designation' => true,
        'birth_date' => true,
        'anniversary_date' => true,
        'blood_group' => true,
        'pancard' => true,
        'aadharcard' => true,
        'remark' => true,
        'gender' => true,
        'marrital_status' => true,
        'cor_address' => true,
        'cor_city' => true,
        'cor_state' => true,
        'cor_country' => true,
        'cor_pincode' => true,
        'res_address' => true,
        'res_city' => true,
        'res_state' => true,
        'res_country' => true,
        'res_pincode' => true,
        'email' => true,
        'phone' => true,
        'mobile' => true,
        'images' => true,
        'images_dir' => true,
        'services' => true,
        'discount' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'package' => true,
        'member_group' => true
    ];
}
