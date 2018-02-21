<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReservationRates Model
 *
 * @property \App\Model\Table\ReservationsTable|\Cake\ORM\Association\BelongsTo $Reservations
 * @property \App\Model\Table\RoomRatesTable|\Cake\ORM\Association\BelongsTo $RoomRates
 *
 * @method \App\Model\Entity\ReservationRate get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReservationRate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReservationRate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReservationRate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReservationRate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReservationRate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReservationRate findOrCreate($search, callable $callback = null, $options = [])
 */
class ReservationRatesTable extends Table
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

        $this->setTable('reservation_rates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Reservations', [
            'foreignKey' => 'reservation_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RoomRates', [
            'foreignKey' => 'room_rate_id',
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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['reservation_id'], 'Reservations'));
        $rules->add($rules->existsIn(['room_rate_id'], 'RoomRates'));

        return $rules;
    }
}
