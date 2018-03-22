<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RestaurantTableBookings Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Properties
 *
 * @method \App\Model\Entity\RestaurantTableBooking get($primaryKey, $options = [])
 * @method \App\Model\Entity\RestaurantTableBooking newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RestaurantTableBooking[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantTableBooking|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RestaurantTableBooking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantTableBooking[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantTableBooking findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RestaurantTableBookingsTable extends Table
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

        $this->setTable('restaurant_table_bookings');
        $this->setDisplayField('name');
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
            ->scalar('restaurant_table_ids')
            ->maxLength('restaurant_table_ids', 255)
            ->requirePresence('restaurant_table_ids', 'create')
            ->notEmpty('restaurant_table_ids');

        $validator
            ->date('booking_date')
            ->requirePresence('booking_date', 'create')
            ->notEmpty('booking_date');

        $validator
            ->time('booking_time')
            ->requirePresence('booking_time', 'create')
            ->notEmpty('booking_time');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('book_by')
            ->maxLength('book_by', 255)
            ->requirePresence('book_by', 'create')
            ->notEmpty('book_by');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('address')
            ->allowEmpty('address');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 15)
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator
            ->integer('no_of_pax')
            ->requirePresence('no_of_pax', 'create')
            ->notEmpty('no_of_pax');

        $validator
            ->scalar('remarks')
            ->requirePresence('remarks', 'create')
            ->notEmpty('remarks');

        $validator
            ->integer('booking_status')
            ->requirePresence('booking_status', 'create')
            ->notEmpty('booking_status');

        $validator
            ->decimal('advanced_payment')
            ->requirePresence('advanced_payment', 'create')
            ->notEmpty('advanced_payment');

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
        $rules->add($rules->existsIn(['property_id'], 'Properties'));

        return $rules;
    }
}
