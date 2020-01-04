<?php
/**
 * Setting Contract
 *
 * @author: tuanha
 * @last-mod: 04-Jan-2020
 */
namespace Bkstar123\LaraTune\Contracts;

interface Setting
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * @param string $key
     * @return string|null
     */
    public function get(string $key, $default = null);

    /**
     * @param string $key
     * @param string $value
     * @return bool
     *
     * @throws \Throwable
     */
    public function set(string $key, string $value) : bool;

    /**
     * @param string $key
     * @return bool
     */
    public function forget(string $key) : bool;

    /**
     * @return void
     */
    public function purge();
}
