<?php

function create($class, $attributes = [], $times=null, $state)
{
    return factory($class, $state, $times)->create($attributes);
}

function make($class, $attributes = [], $times=null, $state)
{
    return factory($class, $state, $times)->make($attributes);
}

?>
