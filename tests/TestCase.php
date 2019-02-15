<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    function create($class, $attributes = [])
    {
        return factory($class)->create($attributes);
    }

    function make($class, $attributes = [])
    {
        return factory($class)->make($attributes);
    }

    protected function signIn($user=null)
    {
        $user = $user ?: create ('App\User');
        $this->actingAs($user);
        return $this;
    }

}
