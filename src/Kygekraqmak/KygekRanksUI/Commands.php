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
 * Copyright (C) 2020-2021 Kygekraqmak
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
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\utils\TextFormat;

class Commands extends PluginCommand {

    private $main;
    private $prefix;

    public function __construct(Main $main, string $desc, array $aliases) {
        $this->main = $main;
        $this->prefix = TextFormat::YELLOW . "[KygekRanksUI] ";
        if ($desc == null) {
            $desc = "Information about ranks in the server";
        }
        parent::__construct("ranks", $main);
        $this->setPermission("kygekranksui.ranks");
        $this->setAliases($aliases);
        $this->setUsage("/ranks");
        $this->setDescription($desc);
    }

    public function main(): Main {
        return $this->main;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool {
        if (!$sender instanceof Player) $sender->sendMessage($this->prefix . TextFormat::RED . "This command only works in-game!");
        else {
            if ($sender->hasPermission("kygekranksui.ranks")) {
                if (file_exists($this->main()->getDataFolder()."config.yml")) {
                    $this->main()->getConfig()->reload();
                    $this->main()->ranksMenu($sender);
                } else {
                    $sender->sendMessage($this->prefix . TextFormat::RED . "Config file cannot be found, please restart the server!");
                }
            } else {
                $sender->sendMessage($this->prefix . TextFormat::RED . "You do not have permission to use this command!");
            }
        }
        return true;
    }

}
