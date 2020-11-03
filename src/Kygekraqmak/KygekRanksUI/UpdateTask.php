<?php

declare(strict_types=1);

namespace Kygekraqmak\KygekRanksUI;

use JackMD\UpdateNotifier\UpdateNotifier;
use pocketmine\scheduler\AsyncTask;

class UpdateTask extends AsyncTask {

    private $main;

    public function __construct(Main $main) {
        $this->main = $main;
    }

    public function onRun() {
        if ($this->main->getConfig()->get("check-updates", true)) {
            UpdateNotifier::checkUpdate("KygekRanksUI", "1.3.0");
        }
    }

}