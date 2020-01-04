<?php
/**
 * Setting Facade
 *
 * @author: tuanha
 * @last-mod: 04-Jan-2020
 */
namespace Bkstar123\LaraTune\Facades;

use Illuminate\Support\Facades\Facade;

class Setting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'setting';
    }
}
