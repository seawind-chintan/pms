<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WaterparkIssuedBelts Model
 *
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 * @property \App\Model\Table\WaterparkTicketsTable|\Cake\ORM\Association\BelongsTo $WaterparkTickets
 * @property \App\Model\Table\WaterparkBeltsTable|\Cake\ORM\Association\BelongsTo $WaterparkBelts
 *
 * @method \App\Model\Entity\WaterparkIssuedBelt get($primaryKey, $options = [])
 * @method \App\Model\Entity\WaterparkIssuedBelt newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WaterparkIssuedBelt[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkIssuedBelt|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WaterparkIssuedBelt patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkIssuedBelt[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkIssuedBelt findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WaterparkIssuedBeltsTable extends Table
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

        $this->setTable('waterpark_issued_belts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('WaterparkTickets', [
            'foreignKey' => 'ticket_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('WaterparkBelts', [
            'foreignKey' => 'belt_id',
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
            ->date('issued_date')
            ->requirePresence('issued_date', 'create')
            ->notEmpty('issued_date');

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
        $rules->add($rules->existsIn(['ticket_id'], 'WaterparkTickets'));
        $rules->add($rules->existsIn(['belt_id'], 'WaterparkBelts'));

        return $rules;
    }
}
