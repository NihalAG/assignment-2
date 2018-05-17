<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Coverage Model
 *
 * @method \App\Model\Entity\Coverage get($primaryKey, $options = [])
 * @method \App\Model\Entity\Coverage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Coverage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Coverage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Coverage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Coverage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Coverage findOrCreate($search, callable $callback = null, $options = [])
 */
class CoverageTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public $paginate = [
        'limit' => 10
    ];
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->setTable('coverage');
        $this->setDisplayField('id');
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
            ->notEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('Coverage_Name')
            ->requirePresence('Coverage_Name', 'create')
            ->notEmpty('Coverage_Name');

        $validator
            ->integer('Cost')
            ->requirePresence('Cost', 'create')
            ->notEmpty('Cost');

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
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }
}
