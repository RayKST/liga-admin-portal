# Liga Admin Portal

Admin portal for managing a collection of trading cards from different card games.

The project was developed as a technical test for Liga Magic and provides an authenticated interface for creating, viewing, editing, and deleting cards.

## Features

* User authentication using PHP sessions
* Protected application pages and API routes
* Card listing
* Create cards
* Edit cards
* Delete cards
* Support for multiple card games:

  * Magic: The Gathering
  * Pokémon
  * Yu-Gi-Oh!
* Edition selection based on the selected card game
* Card image URLs
* Card rarity
* English and Portuguese card names
* Responsive interface
* MySQL persistence
* Dockerized development environment
* REST-like JSON API


## Requirements

Before running the project, make sure you have:

* Git
* Docker
* Docker Compose

No PHP, Apache, or MySQL installation is required on the host machine because they run inside Docker.

## Running the Project

Clone the repository:

```bash
git clone https://github.com/RayKST/liga-admin-portal.git
```

Enter the project directory:

```bash
cd liga-admin-portal
```

Start the containers:

```bash
docker compose up -d --build
```

Docker will build the PHP/Apache application container and start the MySQL container.

The application will be available at:

```text
http://localhost:8080
```

## Default User

The seed creates an initial administrator account:

```text
Email: admin@example.com
```

The password is defined through the password hash stored in `database/seed.sql`.

Use the seeded credentials to access the login page.

## Design Decisions

### Docker

Docker is a **feature decision** and provides a consistent PHP/Apache/MySQL environment and avoids requiring developers to manually configure PHP, Apache, and MySQL on their machines.


## Confirmation on Critical Actions

Critical actions such as deleting cards require user confirmation before being executed.

This was chosen as a **UX decision** to prevent accidental actions and give users an opportunity to cancel potentially destructive operations. The confirmation step adds a small amount of friction in exchange for reducing the risk of unintended data loss.


### Button Colors and Visual Affordance

The interface uses different button colors to help users quickly understand the purpose and potential impact of an action.

Primary actions use the project's primary color, while secondary actions use a neutral style and destructive actions such as deletion use a red color.

This was chosen as a **UX decision** to make the interface more intuitive, especially for users with less technical experience. Consistent visual cues help users recognize important actions without needing to understand the underlying system or technical terminology.

## Card Images as URLs

Card images are stored as URLs rather than uploading and storing the actual image files in the application.

This was chosen as a **feature decision** because using external image URLs is a simpler and safer approach for the current scope of the project. It avoids the need to handle file uploads, storage management, file validation, filesystem permissions, image processing, and potentially large files on the application server.

The database therefore stores only the image URL, while the actual image is retrieved by the browser when the card is displayed.

## License

This project is licensed under the MIT License.