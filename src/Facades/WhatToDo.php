<?php

namespace AbdulsalamEmesh\WhatToDo\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection getTask()
 * @method static WhatToDo category(string $category)
 * @method static WhatToDo person(int $person)
 * @method static WhatToDo cost(string $cost)
 * @method static WhatToDo language(string $language)
 * @method static WhatToDo identifier(string $identifier)
 * @method static Collection create(array $data)
 */
class WhatToDo extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \AbdulsalamEmesh\WhatToDo\WhatToDo::class;
    }
}
