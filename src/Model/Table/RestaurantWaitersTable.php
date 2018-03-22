<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RestaurantWaiters Model
 *
 * @method \App\Model\Entity\RestaurantWaiter get($primaryKey, $options = [])
 * @method \App\Model\Entity\RestaurantWaiter newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RestaurantWaiter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantWaiter|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RestaurantWaiter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantWaiter[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantWaiter findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RestaurantWaitersTable extends Table
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

        $this->setTable('restaurant_waiters');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('property_ids')
            ->maxLength('property_ids', 255)
            ->requirePresence('property_ids', 'create')
            ->notEmpty('property_ids');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
