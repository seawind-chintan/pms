<?php

namespace AdminTheme\View\Helper;

use Cake\View\Helper\FormHelper as OldHelper;
use Cake\View\View;

class FormHelper extends OldHelper{

	public function initialize(array $config){
		parent::initialize($config);
		$this->config('templates',[
	        'button' => '<button class="btn" {{attrs}}>{{text}}</button>',
	        // 'dateWidget' => '{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}',
	        // 'error' => '<div class="error-message">{{content}}</div>',
	        // 'errorList' => '<ul>{{content}}</ul>',
	        // 'errorItem' => '<li>{{text}}</li>',
	        'checkboxFormGroup' => '<div class="checkbox">{{label}}</div>',
	        'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
	        'file' => '<input class="form-control" type="file" name="{{name}}"{{attrs}}>',
	        'formStart' => '<form role="form"{{attrs}}>',
	        'formGroup' => '<div class="form-group">{{label}}{{input}}</div>',
	        // 'hiddenBlock' => '<div style="display:none;">{{content}}</div>',
	        'input' => '<input class="form-control" type="{{type}}" name="{{name}}"{{attrs}}/>',
	        'inputSubmit' => '<input class="btn btn-default" type="{{type}}"{{attrs}}/>',
	        'inputContainer' => '{{content}}',
	        // 'inputContainerError' => '<div class="input {{type}}{{required}} error">{{content}}{{error}}</div>',
	        // 'label' => '<label{{attrs}}>{{text}}</label>',
	        // 'nestingLabel' => '{{hidden}}<label{{attrs}}>{{input}}{{text}}</label>',
	        // 'multicheckboxTitle' => '<legend>{{text}}</legend>',
	        // 'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
	        'select' => '<select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select>',
	        'selectMultiple' => '<select class="form-control" name="{{name}}[]" multiple="multiple"{{attrs}}>{{content}}</select>',
	        'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
	        'radioWrapper' => '<div class="radio">{{label}}</div>',
	        'textarea' => '<textarea class="form-control" name="{{name}}"{{attrs}}>{{value}}</textarea>',
	        'submitContainer' => '<div class="form-group">{{content}}</div>',
		]);
	}

	public function __construct(View $View, array $config = []){
		$this->_defaultWidgets['datetime'] = ['\AdminTheme\View\Widget\DateTimeWidget', 'select'];
		parent::__construct($View, $config);
		// $this->addWidget('datetime',['\AdminTheme\View\Widget\DateTimeWidget', 'select']);
	}

}