# AdminTheme plugin for CakePHP

This plugin is a theme for CakePHP 3 based on the [Sbadmin 2](https://startbootstrap.com/template-overviews/sb-admin-2) Bootstrap theme.

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require falco442/cake-3-admin-theme
```

then activate the plugin in `src/config/bootstrap.php`

```
Plugin::load('AdminTheme',['bootstrap'=>true]);
```

## Form helper

Activate this theme's Form Helper by adding it in `src/View/AppView.php`

```
    public function initialize(){
    	...
        $this->loadHelper('AdminTheme.Form');
        $this->loadHelper('AdminTheme.Sidebar',[
            'sideLinks'=>[
                [
                    'label'=>'Users',
                    'icon'=>'fa-user',
                    'sons'=>[
                        [
                            'label'=>'List',
                            'url'=>['controller'=>'users','action'=>'index'],
                        ],
                        [
                            'label'=>'Add',
                            'url'=>['controller'=>'users','action'=>'add'],
                        ]
                    ]
                ],
                [
                    'label'=>'Stores',
                    'icon'=>'fa-store',
                    'sons'=>[
                        [
                            'url'=>['controller'=>'stores','action'=>'index'],
                            'label'=>'List'
                        ]
                    ]
                ]
            ]
        ]);
        ...
    }
```

## Bake

This plugin includes a template for bake. You can bake your views using 

```
cd cake-root/bin && ./cake bake views --theme=AdminTheme [ModelName]
```

or

```
cd cake-root/bin && ./cake bake all --theme=AdminTheme [ModelName]
```
