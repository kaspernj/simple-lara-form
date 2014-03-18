# SimleLaraForm

```php
<?= SimpleLaraForm($model, null, function($f){
  $f.input("name");
  $f.input("description", array("as" => "textarea"));
  $f.submit();
})?>
```
