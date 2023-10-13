# Laravel Eloquent Settings

Laravel Eloquent Settings is a powerful package for managing model-specific settings in Laravel applications. This package provides a flexible and efficient way to define, handle, and persist settings for your Eloquent models.

## Installation

You can install the package via composer:

```bash
composer require a1383n/laravel-eloquent-settings
```

Next, publish the configuration file:

```bash
php artisan vendor:publish --provider=LaravelEloquentSettings\EloquentSettingsServiceProvider
```

This will create a configuration file at `config/eloquent_settings.php` and a migration at `database/migeration/**_create_eloquent_settings_table.php` 

Run the migrations to create the necessary database table:

```bash
php artisan migrate
```


## Usage
### Implement HasSettingsInterface on your Model
First, make sure your model implements the `HasSettingsInterface` and uses the `HasSettings` trait. Implement the `definedSettings` method to define the settings for your model:

```php
use Illuminate\Database\Eloquent\Model;
use LaravelEloquentSettings\Enums\SettingValueType;
use LaravelEloquentSettings\Contracts\HasSettingsInterface;
use LaravelEloquentSettings\HasSettings;

class User extends Model implements HasSettingsInterface
{
    use HasSettings;

    public function definedSettings(SettingDefinition $definition): void
    {
        $definition->define('locale')
            ->type(SettingValueType::STRING)
            ->default('fa-IR');

        $definition->define('extra')
            ->type(SettingValueType::ARRAY)
            ->nullable();
    }
}
```

### Use Settings

Now that you've defined settings, you can interact with them through the `SettingHandler`:

```php
use App\Models\User;

$user = User::findOrFail(1);
$user->getSettingValueByName('locale');
$user->setSettingValueByName('locale', 'en-US');
```

### SettingResolver and SettingSetter

The package also provides `SettingResolver` and `SettingSetter` for handling setting resolution and updates:

```php
use LaravelEloquentSettings\EloquentSettings;
use LaravelEloquentSettings\SettingResolver;
use LaravelEloquentSettings\SettingSetter;
use App\Models\User;

$handler = EloquentSettings::getHandler(User::find(1));

$resolver = new SettingResolver($handler);
$value = $resolver($settings->get('locale'));

$setter = new SettingSetter($handler);
$setter('extra', ['foo' => 'bar']);
```

## Configuration

You can customize the package behavior by modifying the `eloquent_settings.php` configuration file. Adjust settings such as the database table name and default values according to your requirements.

## Credits

This package is inspired by the need for a simple and effective way to manage model-specific settings in Laravel applications.

## License

Laravel Eloquent Settings is open-sourced software licensed under the [MIT license](LICENSE.md).
