<?php

declare(strict_types=1);

namespace thebigcrafter\Hydrogen;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

final class HConfig {
	public static function verifyConfigVersion(Config $config, string $version) : bool {}

	public static function resetConfig(PluginBase $plugin) : void {}
}
