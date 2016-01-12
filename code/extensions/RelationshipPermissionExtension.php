<?php

/**
 * @author marcus
 */
class RelationshipPermissionExtension extends DataExtension {
	
	protected $permissionSourceRelation;
	
	public function __construct($relationName) {
		parent::__construct();
		
		$this->permissionSourceRelation = $relationName;
	}
	
	/**
	 * Check for a View permission only if the item exists in the DB
	 * @param type $member
	 * @return type 
	 */
	public function canView($member=null) {
		return $this->check(__FUNCTION__, $member);
	}

	public function canEdit($member=null) {
		return $this->check(__FUNCTION__, $member);
	}

	public function canDelete($member=null) {
		return $this->check(__FUNCTION__, $member);
	}

	public function canPublish($member=null) {
		return $this->check(__FUNCTION__, $member);
	}
	
	public function check($perm, $member = null) {
		$sourceRel = $this->permissionSourceRelation;
		if ($this->owner->hasMethod($sourceRel)) {
			$component = $this->owner->$sourceRel();
			if ($component instanceof DataObject && $component->exists()) {
				if ($component->$perm($member) === true) { // fully boolean test
					return true;
				}
			} else if ($component instanceof SS_List) {
				foreach ($component as $item) {
					if ($item->$perm($member) === true) { // fully boolean test
						return true;
					}
				}
			}
		}
	}
}
