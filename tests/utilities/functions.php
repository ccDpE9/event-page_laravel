<?php

function create($class, $attributes = [], $times=null, $states)
{
    return $states 
        ? factory($class, $times)->states($states)->create($attributes)
        : factory($class, $times)->create($attributes);
}

function make($class, $attributes = [], $times=null, $states)
{
    return $states 
        ? factory($class, $times)->states($states)->make($attributes)
        : factory($class, $times)->make($attributes);
}

?>
