Flash module for Hanariu framework with Twitter Bootstrap integration
===========================

Basic flash module with Twitter Bootstrap view

Available message types:

* info - blue
* success - green
* warning - yellow
* error - red

##Requires
* Hanariu Framework https://github.com/hanariu
* Hanariu Session module https://github.com/Hanariu/session
* (optional) Twitter Bootstrap http://twitter.github.io/bootstrap/


##Installation
* `cd modules`
* `git clone git@github.com:vokiel/hanariu-flash.git ./flash`
* Enable module in `bootstrap.php`

```php
Hanariu::modules(array(
    // ...
    'flash'        => MODPATH.'flash',
    // ...
));
```

##Usage

###Adding new messages
* Fast-way

```php
use \Hanariu\Flash as Flash;

Flash::info('Light blue message - just an info');

Flash::success('Green message - OK');

Flash::warning('Yellow message - not sure');

Flash::error('Red - something went really bad!');
```

* Longer way - usable when flash messages are generated automatically (with the message type)

```php
use \Hanariu\Flash as Flash;

// ...
$result = $obj->method();
/*
stdClass Object
(
  [type] => success
  [message] => Message body
)
*/

Flash::add($result->type, $result->message);
```

###Render messages

Usage in Controller Template before method

* Use default Bootstrap view

```php
use Hanariu\Flash as Flash;

// ...
public function before()
{
  // ...
  $flash = Flash::render();
  $this->content = View::factory('main')->bind('flash',$flash);
  // ...
}
```

* Use own view

```php
  // ...
  $flash = Flash::render('messages/flash');
  $this->content = View::factory('main')->bind('flash',$flash);
  // ...
```

###Name message type in your language

If you want to use own message names just copy default view to `app/views/flash/bootstrap.php` and add your code, for example:
```php
&lt;?php namespace Hanariu; ?&gt;

&lt;?php
$message_names = array(
  'info' => 'Informacja',
  'success' => 'Powodzenie',
  'warning' => 'Ostrzeżenie',
  'error' => 'Błąd'
);
?&gt;

&lt;?php if ( !empty($messages) && \Hanariu\Arr::is_array($messages) ): ?&gt;

 &lt;?php foreach ( $messages as $message ): ?&gt;

   &lt;div class="alert alert-&lt;?php echo $message['type']; ?&gt;"&gt;
     &lt;button type="button" class="close" data-dismiss="alert"&gt;&times;&lt;/button&gt;
     &lt;strong&gt;&lt;?php echo $message_names[$message['type']];?&gt;&lt;/strong&gt;: &lt;?php echo $message['message']; ?&gt;
   &lt;/div&gt;

 &lt;?php endforeach; ?&gt;

&lt;?php endif; ?&gt;
```
