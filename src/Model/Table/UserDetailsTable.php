<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserDetails Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserDetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserDetailsTable extends Table
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

        $this->setTable('user_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        /*$this->addBehavior('Josegonzalez/Upload.Upload', [
            'profile_pic',
        ]);*/
        // Add the behaviour and configure any options you want
        $this->addBehavior('Proffer.Proffer', [
            'profile_pic' => [    // The name of your upload field
                'root' => WWW_ROOT . 'img/uploads', // Customise the root upload folder here, or omit to use the default
                'dir' => 'profile_pic_dir',   // The name of the field to store the folder
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

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
            ->integer('city')
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->integer('state')
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        $validator
            ->integer('country')
            ->requirePresence('country', 'create')
            ->notEmpty('country');

        $validator
            ->scalar('pincode')
            ->maxLength('pincode', 50)
            ->requirePresence('pincode', 'create')
            ->notEmpty('pincode');

        $validator
            ->scalar('address')
            ->allowEmpty('address');

        $validator->provider('proffer', 'Proffer\Model\Validation\ProfferRules');
        // Set the thumbnail resize dimensions
        $validator->add('profile_pic', 'proffer', [
            'rule' => ['dimensions', [
                'min' => ['w' => 100, 'h' => 100],
                'max' => ['w' => 500, 'h' => 500]
            ]],
            'message' => 'Image is not correct dimensions.',
            'provider' => 'proffer'
        ])->allowEmpty('profile_pic');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
