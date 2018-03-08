<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Members Model
 *
 * @property \App\Model\Table\PackagesTable|\Cake\ORM\Association\BelongsTo $Packages
 * @property \App\Model\Table\MemberGroupsTable|\Cake\ORM\Association\BelongsTo $MemberGroups
 * @property |\Cake\ORM\Association\HasMany $Reservations
 *
 * @method \App\Model\Entity\Member get($primaryKey, $options = [])
 * @method \App\Model\Entity\Member newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Member[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Member|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Member patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Member[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Member findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MembersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('members');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Members', [
            'foreignKey' => 'parent',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MemberGroups', [
            'foreignKey' => 'member_group_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Reservations', [
            'foreignKey' => 'member_id'
        ]);

        $this->belongsTo('Cities', [
            'foreignKey' => 'cor_city',
            'joinType' => 'INNER',
            'propertyName' => 'cor_city'
        ]);

        $this->belongsTo('States', [
            'foreignKey' => 'cor_state',
            'joinType' => 'INNER',
            'propertyName' => 'cor_state'
        ]);

        $this->belongsTo('Countries', [
            'foreignKey' => 'cor_country',
            'joinType' => 'INNER',
            'propertyName' => 'cor_country'
        ]);

        // Add the behaviour and configure any options you want
        $this->addBehavior('Proffer.Proffer', [
            'images' => [    // The name of your upload field
                'root' => WWW_ROOT . 'img/uploads', // Customise the root upload folder here, or omit to use the default
                'dir' => 'images_dir',   // The name of the field to store the folder
                'thumbnailSizes' => [ // Declare your thumbnails
                    'square' => [   // Define the prefix of your thumbnail
                        'w' => 200, // Width
                        'h' => 200, // Height
                        'jpeg_quality'  => 100
                    ],
                    'portrait' => [     // Define a second thumbnail
                        'w' => 300,
                        'h' => 300
                    ],
                ],
                'thumbnailMethod' => 'gd'   // Options are Imagick or Gd
            ]
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('member_type')
            ->requirePresence('member_type', 'create')
            ->notEmpty('member_type');

        $validator
            ->scalar('code')
            ->maxLength('code', 255)
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->scalar('nick_name')
            ->maxLength('nick_name', 255)
            ->allowEmpty('nick_name');

        $validator
            ->scalar('application_no')
            ->maxLength('application_no', 100)
            ->requirePresence('application_no', 'create')
            ->notEmpty('application_no');

        $validator
            ->scalar('occupation')
            ->maxLength('occupation', 255)
            ->allowEmpty('occupation');

        $validator
            ->scalar('organization')
            ->maxLength('organization', 255)
            ->allowEmpty('organization');

        $validator
            ->scalar('designation')
            ->maxLength('designation', 255)
            ->allowEmpty('designation');

        $validator
            ->date('birth_date')
            ->allowEmpty('birth_date');

        $validator
            ->date('anniversary_date')
            ->allowEmpty('anniversary_date');

        $validator
            ->scalar('blood_group')
            ->maxLength('blood_group', 25)
            ->allowEmpty('blood_group');

        $validator
            ->scalar('pancard')
            ->maxLength('pancard', 25)
            ->requirePresence('pancard', 'create')
            ->notEmpty('pancard');

        $validator
            ->scalar('aadharcard')
            ->maxLength('aadharcard', 25)
            ->allowEmpty('aadharcard');

        $validator
            ->scalar('remark')
            ->allowEmpty('remark');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 10)
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->scalar('marrital_status')
            ->maxLength('marrital_status', 10)
            ->allowEmpty('marrital_status');

        $validator
            ->scalar('cor_address')
            ->requirePresence('cor_address', 'create')
            ->notEmpty('cor_address');

        $validator
            ->scalar('cor_city')
            ->maxLength('cor_city', 100)
            ->requirePresence('cor_city', 'create')
            ->notEmpty('cor_city');

        $validator
            ->scalar('cor_state')
            ->maxLength('cor_state', 100)
            ->requirePresence('cor_state', 'create')
            ->notEmpty('cor_state');

        $validator
            ->scalar('cor_country')
            ->maxLength('cor_country', 100)
            ->requirePresence('cor_country', 'create')
            ->notEmpty('cor_country');

        $validator
            ->scalar('cor_pincode')
            ->maxLength('cor_pincode', 10)
            ->requirePresence('cor_pincode', 'create')
            ->notEmpty('cor_pincode');

        $validator
            ->scalar('res_address')
            ->allowEmpty('res_address');

        $validator
            ->scalar('res_city')
            ->maxLength('res_city', 100)
            ->allowEmpty('res_city');

        $validator
            ->scalar('res_state')
            ->maxLength('res_state', 100)
            ->allowEmpty('res_state');

        $validator
            ->scalar('res_country')
            ->maxLength('res_country', 100)
            ->allowEmpty('res_country');

        $validator
            ->scalar('res_pincode')
            ->maxLength('res_pincode', 10)
            ->allowEmpty('res_pincode');

        $validator
            ->email('email')
            ->requirePresence('email', 'email')
            ->notEmpty('email');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->allowEmpty('phone');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 15)
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator->provider('proffer', 'Proffer\Model\Validation\ProfferRules');
        // Set the thumbnail resize dimensions
        $validator->add('images', 'proffer', [
            'rule' => ['dimensions', [
                'min' => ['w' => 100, 'h' => 100],
                'max' => ['w' => 1500, 'h' => 1500]
            ]],
            'message' => 'Image is not correct dimensions.',
            'provider' => 'proffer'
        ])->allowEmpty('images');

        $validator
            ->scalar('images_dir')
            ->maxLength('images_dir', 255)
            ->allowEmpty('images_dir');

        $validator
            ->scalar('services')
            ->maxLength('services', 255)
            ->allowEmpty('services');

        $validator
            ->integer('discount')
            ->allowEmpty('discount');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['package_id'], 'Packages'));
        //$rules->add($rules->existsIn(['parent'], 'Users'));
        $rules->add($rules->existsIn(['member_group_id'], 'MemberGroups'));

        return $rules;
    }
}
