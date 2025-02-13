# Multi-User Blog System

A platform for uploading and managing blogs with your own profile.

## Features

- User Authentication ([Laravel Breeze](https://github.com/laravel/breeze)).
- Create and edit blog posts with a rich text editor ([Trix](https://trix-editor.org/)).
- Comments and Likes for posts.
- Notifications for Likes and Comments.
- File attachment support for posts.
- Responsive UI/UX.


## Installation & Setup

- Clone the repository
```shell
git clone https://github.com/yourusername/your-repo-name.git
cd your-repo-name
```

- Install dependencies
```shell
composer install
npm install
```

- Set up environment variables
Copy `.env.example` to `.env` and configure database details.
```shell
cp .env.example .env
php artisan key:generate
```

- Run migrations and seed data
```shell
php artisan migrate --seed
```
(This will create sample users and posts)

- Start the development server
```shell
php artisan serve
npm run dev
```


## Roles and Permissions

- Authenticated users: Can create, edit, and delete their posts and user profiles.
- Guests: Can view blog posts and user profiles.


## License

This project is open-source under [MIT License](https://opensource.org/licenses/MIT).

