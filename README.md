# Duel Monsters Community-Driven

<p align="center"><a href="#" target="_blank"><img src="https://i.pinimg.com/736x/ea/32/b3/ea32b3ea9cc92b2761e3f564292a4504.jpg" width="400" alt="Laravel Logo"></a></p>

## Introduction
This project aims to create a web-based simulator for the Yu-Gi-Oh! Goat format using the Laravel PHP framework. 
It provides a platform for players to build decks, duel against each other, and explore the intricacies of this classic format.

## Features
- Deck Building: Create decks adhering to strict Goat format rules.
- Dueling: Engage in real-time or turn-based duels against other players.
- Card Database: Access a comprehensive database of [Goat format cards](/storage/app/goat-format-cards.json) (from [db.ygoprodeck.com](https://db.ygoprodeck.com/api/v7/cardinfo.php?format=goat), special thx :-)).
- User Profiles: Manage user accounts, track match history, and view statistics.
- Rule Enforcement: Ensure strict adherence to [Goat format regulations](/storage/app/Yu-Gi-Oh_Rulebook_v5.0_GOAT.pdf).

## Installation

1. Clone the repository:
```bash
git clone https://github.com/Jhynn/duel-monsters-community-driven.git
```

2. Install dependencies:
```bash
cd duel-monsters-community-driven
composer install
```

3. Set up environment: 

Create a `.env` file based on the `.env.example` file and configure database credentials, application keys, and other necessary settings.

4. Run migrations:
```bash
php artisan migrate --seed
```

5. Start the development server:
```
php artisan serve
```

## Code of Conduct

In order to ensure that the community is welcoming to all, please review and abide by the [Code of Conduct](/CODE_OF_CONDUCT.md).

## Contributing

Thank you for considering contributing to the Duel Monsters Community-driven project! Please follow these guidelines:

- Fork the repository
- Create a new branch for your feature (consider solve tasks in project page)
- Commit your changes
- Push to your branch   
- Open a pull request

> The pending tasks are on [Github](https://github.com/Jhynn/duel-monsters-community-driven/issues).

## Additional Notes

- Implement robust testing to ensure game logic accuracy and prevent exploits.
- Optimize performance for smooth gameplay, especially during live duels.

## License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT) - see the LICENSE file for details.

## Technology Stack

- Laravel
- SvelteKit (or similar frontend framework)
- MariaDB
- WebSockets (for real-time duels)

## Future Plans

- Implement advanced AI opponents
- Add tournament support
- Expand the card database to include community-made cards that were also accepted by the community through votes
- Add custom design support for card sleeve, trunk and playmate
