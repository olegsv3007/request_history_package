# README

1. Add ClickhouseServiceProvider into your config/app.php file, 'providers' section.
```shell
'providers' => [
  .......
  \PhpClickHouseLaravel\ClickhouseServiceProvider::class,
  .......
```

2. Publish package files
```shell
php artisan vendor:publish
```

3. Add connection for clickhouse into your config/database.php file.
```shell
        'clickhouse' => [
            'driver' => 'clickhouse',
            'host' => env('CLICKHOUSE_HOST'),
            'port' => env('CLICKHOUSE_PORT','8123'),
            'database' => env('CLICKHOUSE_DATABASE','default'),
            'username' => env('CLICKHOUSE_USERNAME','default'),
            'password' => env('CLICKHOUSE_PASSWORD',''),
            'timeout_connect' => env('CLICKHOUSE_TIMEOUT_CONNECT',2),
            'timeout_query' => env('CLICKHOUSE_TIMEOUT_QUERY',2),
            'https' => (bool)env('CLICKHOUSE_HTTPS', null),
            'retries' => env('CLICKHOUSE_RETRIES', 0),
            'settings' => [ // optional
                'max_partitions_per_insert_block' => 300,
            ],
        ],
```

4. Run migration
```shell
php artisan migrate
```

5. Now you can see all requests to your server (use '/history' route).
