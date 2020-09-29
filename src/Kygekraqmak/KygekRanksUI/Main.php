<?php

/**
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
 * Copyright (C) 2020 Kygekraqmak
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 */

declare(strict_types=1);

namespace Kygekraqmak\KygekRanksUI;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

use jojoe77777\FormAPI\SimpleForm;
use Kygekraqmak\KygekRanksUI\Commands;

class Main extends PluginBase {

    public function onEnable() {
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->checkConfig();
        $this->getServer()->getCommandMap()->register("ranks", new Commands(
            $this,
            $this->getConfig()->get("command-description"),
            $this->getConfig()->get("command-aliases")
        ));
    }

    public function checkConfig() {
        if ($this->getConfig()->get("config-version") !== 1.1) {
            $this->getLogger()->notice("Your configuration file is outdated, updating the config.yml...");
            $this->getLogger()->notice("The old configuration file can be found at config_old.yml");
            rename($this->getDataFolder()."config.yml", $this->getDataFolder()."config_old.yml");
            $this->saveResource("config.yml");
            return;
        }
        if ($this->getConfig()->get("reset") === true) {
            $this->getLogger()->notice("Successfully reset the configuration file");
            unlink($this->getDataFolder()."config.yml");
            $this->saveResource("config.yml");
            return;
        }
    }

    public function ranksMenu($player) {
        $form = new SimpleForm(function (Player $player, $data) {
            if ($data === null) return true;
            $buttons = array_keys($this->getConfig()->get("ranks"));
            if (count($buttons) == $data) return;
            $button = $buttons[$data];
            $form2 = new SimpleForm(function (Player $player, $data) {
                if ($data === null) {
                    $this->ranksMenu($player);
                    return true;
                }
                switch ($data) {
                    case 0: $this->ranksMenu($player); break;
                }
            });
            $form2->setTitle($this->replace($player, $this->getConfig()->getNested("ranks." . $button . ".title")));
            $form2->setContent($this->replace($player, $this->getConfig()->getNested("ranks." . $button . ".content")));
            $form2->addButton($this->replace($player, $this->getConfig()->get("return-button")));
            $player->sendForm($form2);
        });
        $form->setTitle($this->replace($player, $this->getConfig()->get("title")));
        $form->setContent($this->replace($player, $this->getConfig()->get("content")));
        foreach (array_keys($this->getConfig()->get("ranks")) as $ranks) {
            if ($this->getConfig()->getNested("ranks." . $ranks . ".button-image") == null) {
                $form->addButton($this->replace($player, $this->getConfig()->getNested("ranks." . $ranks . ".menu-button")));
            } else {
                $form->addButton(
                    $this->replace($player, $this->getConfig()->getNested("ranks." . $ranks . ".menu-button")),
                    1, $this->getConfig()->getNested("ranks." . $ranks . ".button-image")
                );
            }
        }
        $form->addButton($this->replace($player, $this->getConfig()->get("exit-button")));
        $player->sendForm($form);
    }

    public function replace($player, $location) {
        $from = ["{player}", "&"];
        $to = [$player->getName(), "§"];
        $replace = str_replace($from, $to, $location);
        return $replace;
    }

}
