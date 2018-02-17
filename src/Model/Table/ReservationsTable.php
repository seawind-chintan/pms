<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reservations Model
 *
 * @property \App\Model\Table\MembersTable|\Cake\ORM\Association\BelongsTo $Members
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\StatesTable|\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\CountriesTable|\Cake\ORM\Association\BelongsTo $Countries
 * @property \App\Model\Table\ReservationRoomsTable|\Cake\ORM\Association\HasMany $ReservationRooms
 *
 * @method \App\Model\Entity\Reservation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reservation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reservation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reservation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reservation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reservation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reservation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReservationsTable extends Table
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

        $this->setTable('reservations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ReservationRooms', [
            'foreignKey' => 'reservation_id'
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
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->scalar('pincode')
            ->maxLength('pincode', 10)
            ->requirePresence('pincode', 'create')
            ->notEmpty('pincode');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->allowEmpty('phone');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 20)
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator
            ->email('email')
            ->requirePresence('email', 'email')
            ->notEmpty('email');


        $validator
            ->scalar('reservation_type')
            ->requirePresence('reservation_type', 'create')
            ->notEmpty('reservation_type');

        $validator
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

        $validator
            ->integer('no_of_adult')
            ->requirePresence('no_of_adult', 'create')
            ->notEmpty('no_of_adult');

        $validator
            ->integer('no_of_child')
            ->requirePresence('no_of_child', 'create')
            ->notEmpty('no_of_child');

        $validator
            ->integer('no_of_rooms')
            ->requirePresence('no_of_rooms', 'create')
            ->notEmpty('no_of_rooms');

        $validator
            ->scalar('comments')
            ->requirePresence('comments', 'create')
            ->notEmpty('comments');

        $validator
            ->decimal('rate')
            ->requirePresence('rate', 'create')
            ->notEmpty('rate');

        $validator
            ->decimal('discount')
            ->requirePresence('discount', 'create')
            ->notEmpty('discount');

        $validator
            ->decimal('total_cost')
            ->requirePresence('total_cost', 'create')
            ->notEmpty('total_cost');

        return $validator;
    }

    public function validationStep1(Validator $validator)
    {
        $validator
            ->scalar('reservation_type')
            ->requirePresence('reservation_type', 'create')
            ->notEmpty('reservation_type')
            ->add('reservation_type', 'inList', [
                'rule' => ['inList', ['inquiry', 'booking']],
                'message' => 'Please enter a valid reservation type'
            ]);

        /*$validator
            ->date('start_date')
            ->requirePresence('start_date', 'create', ['message' => '22222222222222222222'])
            ->notEmpty('start_date', ['message' => '333333333333333333333333333']);

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create', ['message' => '444444444444444444444444444'])
            ->notEmpty('end_date', ['message' => '555555555555555555555555555']);*/

        return $validator;
    }

    public function validationStep2(Validator $validator)
    {
        $validator
            ->add('start_date', '', [
                'rule' => ['date'],
                'message' => 'Please enter a valid start date'
            ])
            ->add('end_date', '', [
                'rule' => ['date'],
                'message' => 'Please enter a valid end date'
            ]);

        $validator
            ->integer('no_of_adult')
            ->requirePresence('no_of_adult', 'create')
            ->notEmpty('no_of_adult');

        $validator
            ->integer('no_of_child')
            ->requirePresence('no_of_child', 'create')
            ->notEmpty('no_of_child');

        $validator
            ->integer('no_of_rooms')
            ->requirePresence('no_of_rooms', 'create')
            ->notEmpty('no_of_rooms');

        return $validator;
    }

    public function validationStep3(Validator $validator)
    {
        $validator
            ->scalar('member_type')
            ->requirePresence('member_type', 'create')
            ->notEmpty('member_type');

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
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->scalar('pincode')
            ->maxLength('pincode', 10)
            ->requirePresence('pincode', 'create')
            ->notEmpty('pincode');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->allowEmpty('phone');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 20)
            ->requirePresence('mobile', 'create')
            ->notEmpty('mobile');

        $validator
            ->email('email')
            ->requirePresence('email', 'email')
            ->notEmpty('email');


        return $validator;
    }

    public function validationStep4(Validator $validator)
    {
        $validator
            ->scalar('comments')
            ->requirePresence('comments', 'create')
            ->notEmpty('comments');

        $validator
            ->decimal('rate')
            ->requirePresence('rate', 'create')
            ->notEmpty('rate');

        $validator
            ->decimal('discount')
            ->requirePresence('discount', 'create')
            ->notEmpty('discount');

        $validator
            ->decimal('total_cost')
            ->requirePresence('total_cost', 'create')
            ->notEmpty('total_cost');
            
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
        $rules->add($rules->existsIn(['member_id'], 'Members'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));

        return $rules;
    }
}
