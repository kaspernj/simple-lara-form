# SimleLaraForm

For a model in Laravel.
```php
<?=SimpleLaraForm($model, null, function($f){?>
  <?=$f->input("name")?>
  <?=$f->input("description", array("as" => "Textarea"))?>
  <?=$f->submit()?>
<?})?>
```

For a form without a model.
```php
<?=SimpleLaraForm("test", array("url" => "some_url"), function($f){?>
  <?=$f->input("name")?>
  <?=$f->input("description", array("as" => "Textarea"))?>
<?})?>
```

How to generate a list:
```php
<?=$f->input("mylist", array("as" => "Select", "value" => 2, "collection" => array(1 => "Number 1", 2 => "Number 2", 3 => "Number 3")))?>
```
