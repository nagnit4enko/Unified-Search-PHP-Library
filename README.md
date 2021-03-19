
# Prodv.net Unified Search Library v1.0 [RU]
*Документация: [us.prodv.net](https://us.prodv.net/index.php?controller=documentationController&action=index)*

## Установка

- Распаковать по удобному пути
- Указать в composer.json вашего проекта:

```json 
"repositories": [
     {
       "type": "path",
       "url": "/абсолютный/путь/к/библиотеке/"
     }
   ],
   "require": {
     "prodvnet/usearch": "1.0"
   }
```

- Запустить "composer install" в вашем проекте
- Готово

## Использование

Необходимо имортировать классы Config и UnifiedSearchService. Например:

```php
use Prodvnet\UnifiedSearch\Config;
use Prodvnet\UnifiedSearch\UnifiedSearchService;

class YourExampleClass {
    public function someAction() {
        $configData = [
            'login' => 'your_login',
            'password' => 'your_pass',
            'serviceUrl' => 'https://api.us.prodv.net'
        ];
        $us = new UnifiedSearchService(new Config($configData));
    }
}
```

Далее можно использовать методы экземпляра UnifiedSearchService для получения данных веб-сервиса:

```php
use Prodvnet\UnifiedSearch\Config;
use Prodvnet\UnifiedSearch\UnifiedSearchService;

class YourExampleClass {
    public function someAction() {
        $configData = [
            'login' => 'your_login',
            'password' => 'your_pass',
            'serviceUrl' => 'https://api.us.prodv.net'
        ];
        $us = new UnifiedSearchService(new Config($configData));
        
        $us->search('c110', ['limit' => 10, 'skip' => 0])->getTaskList();
        $result = $us->query();
        
        // $result[0] - result of search method
        // $result[1] - result of getTaskList method
    }
}
```



# Prodv.net Unified Search Library v1.0 [ENG]
*Read the documentation for details: [us.prodv.net](https://us.prodv.net/index.php?controller=documentationController&action=index)*

## Installation

- Put library somewhere on your disk
- In your project add to composer.json:

```json 
"repositories": [
     {
       "type": "path",
       "url": "/path/to/usearchlib/"
     }
   ],
   "require": {
     "prodvnet/usearch": "1.0"
   }
```

- Run "composer install" in your project folder
- Enjoy

## Use in application

Now you can import service and config classes to your code. For example:

```php
$configData = [
    'login' => 'your_login',
    'password' => 'your_pass',
    'serviceUrl' => 'https://api.us.prodv.net'
];
$us = new UnifiedSearchService(new Config($configData));
```

Next you can use UnifiedSearchService methods to get some service data:

```php
$configData = [
    'login' => 'your_login',
    'password' => 'your_pass',
    'serviceUrl' => 'https://api.us.prodv.net'
];
$us = new UnifiedSearchService(new Config($configData));

$us->search('c110', ['limit' => 10, 'skip' => 0])->getTaskList();
$result = $us->query();

// $result[0] - result of search method
// $result[1] - result of getTaskList method
```



