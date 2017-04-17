<?php

$base_dir = __DIR__;

return [
    "base_path"        => $base_dir,
    "base_url"         => "FrameMe/public/",
    "public_directory" => "{$base_dir}/public",
    "view_directory"   => "{$base_dir}/app/view",
    "cache_directory"  => "{$base_dir}/app/cache/view",
    "model_namespace"  => "app\\model",
    "model_directory"  => "{$base_dir}/app/model",
    "database"         => [
        "driver"    => "mysql",
        "host"      => "8.8.8.8:3306",
        "database"  => "databae_name",
        "username"  => "database_username",
        "password"  => "some_random_hash",
        "charset"   => "utf8",
        "collation" => "utf8_unicode_ci",
    ],
];