<?php

defined( 'ABSPATH' ) || exit;

namespace LLMS\Core;

// use RecursiveIterator

trait Tree{

	public function get_tree_until_node(){

		if($this->is_root()){
			return false;
		}

		// get all the nodes from root until the current one

	}

	public function get_tree_from_node(){

		if($this->is_leaf()){
			return false;
		}
		// get all the nodes from this node until the last leaves
	}

	public function is_root(){
		// is topmost level node, no parents
	}

	public function is_leaf(){
		// last level node with no children
	}

	public function is_node(){
		// has both parents and children
	}

	public function is_decision_point(){
		// is a decision point
	}
}

