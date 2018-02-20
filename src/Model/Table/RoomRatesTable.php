<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RoomRates Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 * @property \App\Model\Table\RoomPlansTable|\Cake\ORM\Association\BelongsTo $RoomPlans
 * @property \App\Model\Table\RoomTypesTable|\Cake\ORM\Association\BelongsTo $RoomTypes
 * @property \App\Model\Table\RoomOccupanciesTable|\Cake\ORM\Association\BelongsTo $RoomOccupancies
 *
 * @method \App\Model\Entity\RoomRate get($primaryKey, $options = [])
 * @method \App\Model\Entity\RoomRate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RoomRate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RoomRate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoomRate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RoomRate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RoomRate findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RoomRatesTable extends Table
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

        $this->setTable('room_rates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RoomPlans', [
            'foreignKey' => 'room_plan_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RoomTypes', [
            'foreignKey' => 'room_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RoomOccupancies', [
            'foreignKey' => 'room_occupancy_id',
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
            ->decimal('rate')
            ->requirePresence('rate', 'create')
            ->notEmpty('rate');

        $validator
            ->decimal('extra_charge')
            ->requirePresence('extra_charge', 'create')
            ->notEmpty('extra_charge');

        /*$validator
            ->integer('for_specific_dates')
            ->requirePresence('for_specific_dates', 'create')
            ->notEmpty('for_specific_dates');*/

        $validator
            ->date('from_date')
            //->allowEmpty('from_date');
            ->notEmpty('from_date', 'Must have values in From Date and End Date if specific dates selected', function($context) {
                //return $context['data']?$context['data']['to_date']:false;
                if($context['data']) {
                    if(!empty($context['data']['to_date']) && !empty($context['data']['for_specific_dates'])){
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            });

        $validator
            ->date('to_date')
            //->allowEmpty('to_date');
            ->notEmpty('to_date', 'Must have values in From Date and End Date if specific dates selected', function($context) {
                //return $context['data']?$context['data']['from_date']:false;
                if($context['data']) {
                    if(!empty($context['data']['from_date']) && !empty($context['data']['for_specific_dates'])){
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            });

        $validator
            ->integer('min_adult')
            ->requirePresence('min_adult', 'create')
            ->notEmpty('min_adult');

        $validator
            ->integer('max_adult')
            ->requirePresence('max_adult', 'create')
            ->notEmpty('max_adult');

        $validator
            ->integer('max_child')
            ->requirePresence('max_child', 'create')
            ->notEmpty('max_child');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        /*$validator->add('email', [
            'unique' => [
                'rule' => ['validateUnique', ['scope' => 'site_id']],
                'provider' => 'table'
            ]
        ]);*/

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
        $rules->add($rules->existsIn(['property_id'], 'Properties'));
        $rules->add($rules->existsIn(['room_plan_id'], 'RoomPlans'));
        $rules->add($rules->existsIn(['room_type_id'], 'RoomTypes'));
        $rules->add($rules->existsIn(['room_occupancy_id'], 'RoomOccupancies'));
        //$rules->add($rules->isUnique(['property_id', 'room_plan_id', 'room_type_id', 'room_occupancy_id']));
        $rules->add($rules->isUnique(
            ['property_id', 'room_plan_id', 'room_type_id', 'room_occupancy_id'],
            'This property, plan, room type & occupancy combination has already been used.'
        ));

        return $rules;
    }
}
