<h1 align="center">KygekRanksUI</h1>

<p align="center">
<a href="https://github.com/thebigcrafter/KygekRanksUI/releases"><img src="https://img.shields.io/github/downloads/thebigcrafter/KygekRanksUI/total?style=for-the-badge" alt="GitHub downloads" /></a>
<a href="https://github.com/thebigcrafter/KygekRanksUI#GPL-3.0-1"><img src="https://img.shields.io/github/license/thebigcrafter/KygekRanksUI?style=for-the-badge" alt="license" /></a>
<a href="https://discord.gg/PykBfE2TZ9"><img src="https://img.shields.io/discord/1087729577004122112?color=7289DA&label=discord&logo=discord&style=for-the-badge" alt="discord" /></a>
</p>

# 📖 About

An Axolotl-PM plugin that presents configurable rank information in forms. You can provide rank features, prices and contact details for ranks that are purchased through staff or external websites. This plugin does not assign ranks, change chat messages or add rank text to player nametags.

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

1. Download the latest version from [GitHub Releases](https://github.com/thebigcrafter/KygekRanksUI/releases). Use an older release only when investigating a compatibility issue.
2. Place the `KygekRanksUI.phar` file into the `plugins` folder.
3. Restart Axolotl-PM.
4. Done!

# 🛠️ Development

Install the locked Composer dependencies and use DevTools to package and validate the plugin PHAR. The packaging metadata resolves the pinned FormsUI and Hydrogen virions without copying a builder release version into user-facing documentation.

```sh
composer install
```

# 📜 Commands & Permissions

| Command | Default Description | Permission | Default |
| --- | --- | --- | --- |
| `/ranks` | Information about ranks in the server | `kygekranksui.ranks` | true |

💡 Tips:
- Command description can be changed in `config.yml`. You can also add command aliases in `config.yml`.
- Use `-kygekranksui.ranks` to blacklist the `/ranks` command permission to groups/users in PurePerms.

# ⚖️ License

Licensed under the [GNU General Public License v3.0](https://github.com/thebigcrafter/KygekRanksUI#GPL-3.0-1) license.
