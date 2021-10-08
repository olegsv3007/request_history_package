<?php

use \PhpClickHouseLaravel\Migration;

class CreateCHRequestsTable extends Migration
{
    public function up()
    {
        static::write('
            CREATE TABLE requests (
                id String,
                ip IPv4,
                url String,
                user_id UInt32,
                response_code UInt16,
                method String,
                created_at DateTime
            )
            ENGINE = MergeTree()
            ORDER BY (id)
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        static::write('DROP TABLE requests');
    }
}
