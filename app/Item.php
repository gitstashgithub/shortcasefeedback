<?php

namespace App;

use Baum\Node;

class Item extends Node
{
    public function techniques()
    {
        return $this->hasMany(Technique::class);
    }
}
