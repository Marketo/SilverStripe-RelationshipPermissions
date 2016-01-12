<?php

/**
 * @author marcus
 */
class TestRelationshipPermission extends SapphireTest {
	protected $extraDataObjects = array('TypeObjectA', 'TypeObjectB', 'TypeObjectC');
	
	public function testSingleRelationship() {
		
		
		$object = new TypeObjectA;
		
		$cant = $object->canView();
		
		$this->assertFalse($cant);
		
		TypeObjectA::add_extension("RelationshipPermissionExtension('Single')");
		
		$object = new TypeObjectA;
		
		$b = new TypeObjectB();
		$b->write();
		$object->SingleID = $b->ID;
		
		$can = $object->canView();
		$this->assertTrue($can);
		
		TypeObjectA::remove_extension('RelationshipPermissionExtension');
		
		TypeObjectA::add_extension("RelationshipPermissionExtension('Multi')");
		
		$object = new TypeObjectA;
		$object->write();
		
		$c = new TypeObjectC();
		$c->write();
		$object->Multi()->add($c);
		
		$can = $object->canView();
		$this->assertTrue($can);
	}
}

class TypeObjectA extends DataObject implements TestOnly {
	private static $db = array('Title' => 'Varchar');
	private static $has_one = array('Single' => 'TypeObjectB');
	private static $many_many = array('Multi' => 'TypeObjectC');
	
	
}

class TypeObjectB extends DataObject implements TestOnly {
	private static $db = array('Title' => 'Varchar');
	
	public function canView($member = null) {
		return true;
	}
}

class TypeObjectC extends DataObject implements TestOnly {
	private static $db = array('Title' => 'Varchar');
	
	public function canView($member = null) {
		return true;
	}
}