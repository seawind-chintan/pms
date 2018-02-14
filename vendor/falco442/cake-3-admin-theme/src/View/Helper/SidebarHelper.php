<?php

namespace AdminTheme\View\Helper;

use Cake\View\Helper;

class SidebarHelper extends Helper{
	public $helpers = ['Html','Url'];

	public function initialize(array $config){
        // debug($config);
        $this->_mergeConfig($config);
    	// debug($this->_config);
    }

    protected function _mergeConfig(array $config){
    	$this->_config = array_merge($this->_defaultConfig,$config);
    	// self::_validateLink($this->_config['sideLinks']);
    	foreach($this->_config['sideLinks'] as &$link){
    		self::_validateLink($link);
    	}
    }

    static function _validateLink(&$link){
    	if(!isset($link['label'])){
    		$link['label'] = '';
    	}
    	if(!isset($link['icon'])){
    		$link['icon'] = '';
    	}
    	if(!isset($link['url'])){
    		$link['url'] = '';
    	}
    	if(!isset($link['options'])){
    		$link['options'] = [];
    	}
    	if(!isset($link['sons'])){
    		$link['sons'] = [];
    	}
    	if(isset($link['sons']) && !empty($link['sons'])){
    		foreach($link['sons'] as &$son){
	    		self::_validateLink($son);
    		}
    	}
    }

	protected $_defaultConfig = [
		'sideLinks'=>[
			[
				'icon'=>'fa-users',
				'label'=>'Users',
				'sons'=>[
					[
						'icon'=>'',
						'label'=>'List',
						'url'=>['controller'=>'users','action'=>'index']
					]
				]
			]
		]
	];

	protected $_config;


	function link($label, $route = null,$options = [],$icon = '',$sons = []){
		$options['escape'] = false;
		if(!empty($sons)){
			$arrow = ' <span class="fa arrow"></span>';
		}
		else{
			$arrow = '';
		}

		$return = '<li>';

		$label = sprintf('<i class="fa %s fa-fw"></i> %s%s',$icon,$label,$arrow);
		$return .= $this->Html->link($label,$route,$options);

		if(!empty($sons)){
			$return .= '<ul class="nav nav-second-level">';
			foreach($sons as $son){
				$return .= $this->link($son['label'],$son['url'],$son['options'],$son['icon'],$son['sons']);
			}
			$return .= '</ul>';
		}

		$return .= '</li>';
		return $return;
	}

}