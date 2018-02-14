<?php

namespace AdminTheme\View\Helper;

use Cake\View\Helper;
use Cake\View\Helper\FormHelper;

class BootstrapFormHelper extends FormHelper{

	public function initialize(array $config){
		$config['templates'] = [
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
	        'inputSubmit' => '<input class="btn btn-default {{class}}" type="{{type}}"{{attrs}}/>',
	        'inputContainer' => '{{content}}',
	        // 'inputContainerError' => '<div class="input {{type}}{{required}} error">{{content}}{{error}}</div>',
	        // 'label' => '<label{{attrs}}>{{text}}</label>',
	        // 'nestingLabel' => '{{hidden}}<label{{attrs}}>{{input}}{{text}}</label>',
	        // 'multicheckboxTitle' => '<legend>{{text}}</legend>',
	        // 'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
	        'select' => '<select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select>',
	        'selectMultiple' => '<select class="form-control" name="{{name}}[]" multiple="multiple"{{attrs}}>{{content}}</select>',
	        // 'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
	        // 'radioWrapper' => '{{label}}',
	        'textarea' => '<textarea class="form-control" name="{{name}}"{{attrs}}>{{value}}</textarea>',
	        'submitContainer' => '<div class="form-group">{{content}}</div>',
		];

		parent::initialize($config);
		
	}

}