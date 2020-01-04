<?php
/**
 * Setting Serivce
 *
 * @author: tuanha
 * @last-mod: 04-Jan-2020
 */
namespace Bkstar123\LaraTune\Services;

use Illuminate\Support\Facades\Config;
use Bkstar123\LaraTune\Models\Setting as SettingModel;
use Bkstar123\LaraTune\Contracts\Setting as SettingContract;

class Setting implements SettingContract
{
	/**
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function all()
	{
		return SettingModel::all();
	}

	/**
	 * @param string $key
	 * @return string|null
	 */
	public function get(string $key, $default = null)
	{
		$entry = SettingModel::where('key', $key)->first();
		return $entry ? $entry->value : $default;
	}

	/**
	 * @param string $key
	 * @param string $value
	 * @return bool
	 *
	 * @throws \Throwable
	 */
	public function set(string $key, string $value) : bool
	{
		$entry = SettingModel::where('key', $key)->first();
		if ($entry) {
			$entry->value = $value;
			$entry->saveOrFail();
		} else {
			$entry = SettingModel::create([
				'key' => $key,
				'value' => $value
			]);
		}
		Config::set("settings.{$key}", $value);
        if (Config::get("settings.{$key}") === $value) {
            return true;
        }
        return false;
	}

	/**
	 * @param string $key
	 * @return bool
	 */
	public function forget(string $key) : bool
	{
		$entry = SettingModel::where('key', $key)->first();
		if ($entry) {
			if ($entry->delete()) {
				Config::offsetUnset("settings.{$key}");
				return Config::get("settings.{$key}") === null;
			} else {
				return false;
			}
		} else {
			if (Config::has("settings.{$key}")) {
			    Config::offsetUnset("settings.{$key}");
			    return Config::get("settings.{$key}") === null;
		    }
		}
	}

	/**
	 * @return void
	 */
	public function purge()
	{
		$settings = SettingModel::all();
		foreach ($settings as $setting) {
			$this->forget($setting->key);
		}
		SettingModel::truncate();
	}
}