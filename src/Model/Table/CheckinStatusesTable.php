<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CheckinStatuses Model
 *
 * @method \App\Model\Entity\CheckinStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\CheckinStatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CheckinStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CheckinStatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CheckinStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CheckinStatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CheckinStatus findOrCreate($search, callable $callback = null, $options = [])
 */
class CheckinStatusesTable extends Table
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

        $this->setTable('checkin_statuses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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

        return $validator;
    }
}
