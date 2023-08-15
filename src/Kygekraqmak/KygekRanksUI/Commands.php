<?php

/*
 *     _    __                  _                                     _
 *    | |  / /                 | |                                   | |
 *    | | / /                  | |                                   | |
 *    | |/ / _   _  ____   ____| | ______ ____   _____ ______   ____ | | __
 *    | |\ \| | | |/ __ \ / __ \ |/ /  __/ __ \ / __  | _  _ \ / __ \| |/ /
 *    | | \ \ \_| | <__> |  ___/   <| / | <__> | <__| | |\ |\ | <__> |   <
 * By |_|  \_\__  |\___  |\____|_|\_\_|  \____^_\___  |_||_||_|\____^_\|\_\
 *              | |    | |                          | |
 *           ___/ | ___/ |                          | |
 *          |____/ |____/                           |_|
 *
 * A PocketMine-MP plugin that shows information about ranks in the server
 * Copyright (C) 2020-2023 Kygekraqmak, KygekTeam
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * he Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace Kygekraqmak\KygekRanksUI;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\utils\TextFormat;
use function file_exists;
use function file_get_contents;

class Commands extends Command implements PluginOwned {

	private Main $main;
	private string $prefix;

	public function __construct(Main $main, string $desc, array $aliases) {
		$this->main = $main;
		$this->prefix = TextFormat::YELLOW . "[KygekRanksUI] ";
		if ($desc == null) {
			$desc = "Information about ranks in the server";
		}
		parent::__construct("ranks", $desc, "/ranks", $aliases);
		$this->setPermission("kygekranksui.ranks");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) : bool {
		if (!$sender instanceof Player) $sender->sendMessage($this->prefix . TextFormat::RED . "This command only works in-game!");
		else {
			if ($this->testPermissionSilent($sender)) {
				$path = $this->getOwningPlugin()->getDataFolder() . "config.yml";
				if (!file_exists($path) || empty(file_get_contents($path))) {
					$sender->sendMessage($this->prefix . TextFormat::YELLOW . "Configuration file is corrupted or missing, regenerating it...");
					$this->getOwningPlugin()->saveResource("config.yml", true);
				}
				$this->getOwningPlugin()->getConfig()->reload();
				$this->getOwningPlugin()->ranksMenu($sender);
			} else {
				$sender->sendMessage($this->prefix . TextFormat::RED . "You do not have permission to use this command!");
			}
		}
		return true;
	}

	public function getOwningPlugin() : Main {
		return $this->main;
	}

}
