<h1 align="center">KygekRanksUI</h1>

<p align="center">
<a href="https://poggit.pmmp.io/p/KygekRanksUI"><img src="https://poggit.pmmp.io/shield.dl.total/KygekRanksUI?style=for-the-badge" alt="poggit" /></a>
<a href="https://github.com/thebigcrafter/KygekRanksUI/blob/main/LICENSE"><img src="https://img.shields.io/github/license/thebigcrafter/KygekRanksUI?style=for-the-badge" alt="license" /></a>
<a href="https://discord.gg/cEXW8uK6QA"><img src="https://img.shields.io/discord/970294579372912700?color=7289DA&label=discord&logo=discord&style=for-the-badge" alt="discord" /></a>
</p>

# 📖 About

A PocketMine-MP plugin that shows information about ranks in the server. You can provide ranks features, prices and contact details. This is a plugin that showcases ranks that can be purchased via staffs/websites. This is not a plugin for setting up purchaseable ranks using in-game money.

# 🧩 Features

- Unlimited ranks lists
- Missing/corrupted config file detection and handling
- Config file can be reset
- Show player name (`{player}`)
- Supports `&` as formatting codes
- Supports images beside ranks buttons (links and texture packs)
- Change command description to suit your server
- Supports command aliases
- Enable/disable ranks form to go back to main form when pressing the X button
- Automatic plugin updates checker

# ⬇️ Installation

1. Download the latest version (It is recommended to always download the latest version for the best experience, except you're having compatibility issues).
2. Place the `KygekRanksUI.phar` file into the `plugins` folder.
3. Restart the server.
4. Done!

# 📜 Commands & Permissions

| Command | Default Description | Permission | Default |
| --- | --- | --- | --- |
| `/ranks` | Information about ranks in the server | `kygekranksui.ranks` | true |

💡 Tips:
- Command description can be changed in `config.yml`. You can also add command aliases in `config.yml`.
- Use `-kygekranksui.ranks` to blacklist the `/ranks` command permission to groups/users in PurePerms.

# ⚖️ License

Licensed under the [GNU General Public License v3.0](https://github.com/thebigcrafter/KygekRanksUI/blob/main/LICENSE) license.
