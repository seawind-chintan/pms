<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RestaurantTables Model
 *
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 *
 * @method \App\Model\Entity\RestaurantTable get($primaryKey, $options = [])
 * @method \App\Model\Entity\RestaurantTable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RestaurantTable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantTable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RestaurantTable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantTable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantTable findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RestaurantTablesTable extends Table
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

        $this->setTable('restaurant_tables');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
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
            ->scalar('code')
            ->maxLength('code', 100)
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->integer('capacity')
            ->requirePresence('capacity', 'create')
            ->notEmpty('capacity');

        $validator
            ->integer('booking_status')
            ->requirePresence('booking_status', 'create')
            ->notEmpty('booking_status');

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
        $rules->add($rules->existsIn(['property_id'], 'Properties'));

        return $rules;
    }
}
