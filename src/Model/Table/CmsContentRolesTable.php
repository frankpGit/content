<?php
namespace Content\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Content\Model\Entity\CmsContentRole;

/**
 * CmsContentRoles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CmsContents
 * @property \Cake\ORM\Association\BelongsTo $Roles
 */
class CmsContentRolesTable extends Table
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

        $this->table('cms_content_roles');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('CmsContents', [
            'foreignKey' => 'cms_contents_id',
            'joinType' => 'INNER',
            'className' => 'Content.CmsContents'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'roles_id',
            'joinType' => 'INNER',
            'className' => 'Content.Roles'
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
            ->allowEmpty('params');

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
        $rules->add($rules->existsIn(['cms_contents_id'], 'CmsContents'));
        $rules->add($rules->existsIn(['roles_id'], 'Roles'));
        return $rules;
    }
}
