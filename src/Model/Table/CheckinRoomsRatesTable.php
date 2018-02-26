<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CheckinRoomsRates Model
 *
 * @property \App\Model\Table\CheckinsTable|\Cake\ORM\Association\BelongsTo $Checkins
 * @property \App\Model\Table\RoomsTable|\Cake\ORM\Association\BelongsTo $Rooms
 * @property \App\Model\Table\RoomRatesTable|\Cake\ORM\Association\BelongsTo $RoomRates
 *
 * @method \App\Model\Entity\CheckinRoomsRate get($primaryKey, $options = [])
 * @method \App\Model\Entity\CheckinRoomsRate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CheckinRoomsRate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CheckinRoomsRate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CheckinRoomsRate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CheckinRoomsRate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CheckinRoomsRate findOrCreate($search, callable $callback = null, $options = [])
 */
class CheckinRoomsRatesTable extends Table
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

        $this->setTable('checkin_rooms_rates');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Checkins', [
            'foreignKey' => 'checkin_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Rooms', [
            'foreignKey' => 'room_id',
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
        $rules->add($rules->existsIn(['checkin_id'], 'Checkins'));
        $rules->add($rules->existsIn(['room_id'], 'Rooms'));
        $rules->add($rules->existsIn(['room_rate_id'], 'RoomRates'));

        return $rules;
    }
}
