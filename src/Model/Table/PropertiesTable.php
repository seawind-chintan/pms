<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Properties Model
 *
 * @method \App\Model\Entity\Property get($primaryKey, $options = [])
 * @method \App\Model\Entity\Property newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Property[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Property|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Property patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Property[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Property findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PropertiesTable extends Table
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

        $this->setTable('properties');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        //$this->hasMany('PropertyImages');

        $this->belongsTo('PropertyTypes', [
                'className' => 'Publishing.PropertyTypes'
            ])
            ->setForeignKey('type')
            ->setProperty('Type');

        $this->addBehavior('Timestamp');

        //$this->addBehavior('Upload');

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
            ->scalar('code')
            ->maxLength('code', 50)
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->integer('user')
            ->requirePresence('user', 'create')
            ->notEmpty('user');

        $validator
            ->scalar('address')
            ->allowEmpty('address');

        /*$validator->add('images', [
                        'fileSize' => [
                                'rule' => [
                                    'fileSize', '<', '1MB'
                                ],
                                'message' => 'Please upload file smaller than 1MB'
                            ],
                        'mimeType' => [
                            'rule' => [
                                'mimeType', ['image/png']
                            ],
                            'message' => 'Please upload only png images'
                        ]
                    ]
                );*/

        $validator->provider('proffer', 'Proffer\Model\Validation\ProfferRules');
        $validator->add('images', 'proffer', [
            'rule' => ['dimensions', [
                'min' => ['w' => 100, 'h' => 100],
                'max' => ['w' => 500, 'h' => 500]
            ]],
            'message' => 'Image is not correct dimensions.',
            'provider' => 'proffer'
        ])->allowEmpty('profile_pic');


        $validator
            ->time('start_time')
            ->allowEmpty('start_time');

        $validator
            ->time('end_time')
            ->allowEmpty('end_time');

        $validator
            ->integer('sunday_open')
            ->requirePresence('sunday_open', 'create')
            ->notEmpty('sunday_open');

        $validator
            ->integer('monday_open')
            ->requirePresence('monday_open', 'create')
            ->notEmpty('monday_open');

        $validator
            ->integer('tuesday_open')
            ->requirePresence('tuesday_open', 'create')
            ->notEmpty('tuesday_open');

        $validator
            ->integer('wednesday_open')
            ->requirePresence('wednesday_open', 'create')
            ->notEmpty('wednesday_open');

        $validator
            ->integer('thursday_open')
            ->requirePresence('thursday_open', 'create')
            ->notEmpty('thursday_open');

        $validator
            ->integer('friday_open')
            ->requirePresence('friday_open', 'create')
            ->notEmpty('friday_open');

        $validator
            ->integer('saturday_open')
            ->requirePresence('saturday_open', 'create')
            ->notEmpty('saturday_open');

        $validator
            ->scalar('notes')
            ->requirePresence('notes', 'create')
            ->allowEmpty('notes');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
