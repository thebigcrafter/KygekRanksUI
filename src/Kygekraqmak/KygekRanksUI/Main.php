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
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace Kygekraqmak\KygekRanksUI;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use thebigcrafter\Hydrogen\HConfig;
use thebigcrafter\Hydrogen\Hydrogen;
use Vecnavium\FormsUI\SimpleForm;
use function array_filter;
use function array_keys;
use function array_values;
use function count;
use function is_array;
use function is_bool;
use function is_string;
use function mb_stripos;
use function str_replace;

class Main extends PluginBase {

	protected function onEnable() : void {
		$this->saveDefaultConfig();

		Hydrogen::checkForUpdates($this);
		HConfig::verifyConfigVersion($this->getConfig(), "2.2.3");

		$this->getServer()->getCommandMap()->register("ranks", new Commands(
			$this, $this->getStringConfig("command-description"),
			$this->getAliases()
		));
	}

	public function ranksMenu(Player $player) : void {
		$form = new SimpleForm(function (Player $player, ?int $data = null) : bool {
			if ($data === null) return true;
			$buttons = array_keys($this->getRanks());
			if (count($buttons) === $data) return true;
			$button = $buttons[$data];
			$form2 = new SimpleForm(function (Player $player, ?int $data = null) : bool {
				if ($data === null) {
					if ($this->getBoolConfig("return-to-main")) $this->ranksMenu($player);
					return true;
				} elseif ($data === 0) {
					$this->ranksMenu($player);
				}
				return true;
			});
			$form2->setTitle($this->replace($player, $this->getNestedString("ranks." . $button . ".title")));
			$form2->setContent($this->replace($player, $this->getNestedString("ranks." . $button . ".content")));
			$form2->addButton($this->replace($player, $this->getStringConfig("return-button")));
			$player->sendForm($form2);
			return true;
		});
		$form->setTitle($this->replace($player, $this->getStringConfig("title")));
		$form->setContent($this->replace($player, $this->getStringConfig("content")));
		foreach (array_keys($this->getRanks()) as $ranks) {
			$bimage = $this->getNestedString("ranks." . $ranks . ".button-image");
			if ($bimage === "") {
				$form->addButton($this->replace($player, $this->getNestedString("ranks." . $ranks . ".menu-button")));
			} elseif (mb_stripos($bimage, "https://") !== false || mb_stripos($bimage, "http://") !== false) {
				$form->addButton(
					$this->replace($player, $this->getNestedString("ranks." . $ranks . ".menu-button")),
					1, $bimage
				);
			} else {
				$form->addButton(
					$this->replace($player, $this->getNestedString("ranks." . $ranks . ".menu-button")),
					0, $bimage
				);
			}
		}
		$form->addButton($this->replace($player, $this->getStringConfig("exit-button")));
		$player->sendForm($form);
	}

	public function replace(Player $player, string $location) : string {
		return str_replace("{player}", $player->getName(), TextFormat::colorize($location));
	}

	/** @return array<string, mixed> */
	private function getRanks() : array {
		$ranks = $this->getConfig()->get("ranks", []);
		if (!is_array($ranks)) {
			return [];
		}
		$result = [];
		foreach ($ranks as $key => $value) {
			if (is_string($key)) {
				$result[$key] = $value;
			}
		}
		return $result;
	}

	private function getStringConfig(string $key) : string {
		$value = $this->getConfig()->get($key, "");
		return is_string($value) ? $value : "";
	}

	private function getNestedString(string $key) : string {
		$value = $this->getConfig()->getNested($key, "");
		return is_string($value) ? $value : "";
	}

	private function getBoolConfig(string $key) : bool {
		$value = $this->getConfig()->get($key, false);
		return is_bool($value) ? $value : false;
	}

	/** @return list<string> */
	private function getAliases() : array {
		$value = $this->getConfig()->get("command-aliases", []);
		return is_array($value) ? array_values(array_filter($value, is_string(...))) : [];
	}

}
