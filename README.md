# Filter Scoping your Queries
This scopes allow you to add constraints to all queries for a given model. Filter your data easily.


# Installation

Simply add the package to your `composer.json` file and run `composer update`.

```
composer require akr4m/scoping
```

# Usage

Add the trait to your model and your search rules.

```php
use akr4m\scoping\Traits\CanBeScoped;

class Post extends Model
{
    use CanBeScoped;
}
```

Add scopes in `abcController.php` like this

```php
public function __invoke(Request $request)
{
    $posts  = App\Post::withScopes($this->scopes())->get();
}

protected function scopes()
{
    return [
        // Must declare the `Scope` files
        'topic' => new TopicScope(),
        'month' => new MonthScope(),
        'year' => new YearScope(),
    ];
}
```

`TopicScope.php` file would be like this

```php
use akr4m\scoping\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class TopicScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        return $builder
            ->whereHas('topics', function ($builder) use ($topic) {
                $builder->where('slug', $value);
            });
    }
}
```
