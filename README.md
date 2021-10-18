# five
 
Symfony 5
- Login / Logout (Dashboard)
- Example hook

### Symfony / Composer / NPM
- Webpack, Babel, Typescript, Sass...
- Bootstrap

**Create a .env.local file like your local development**
- Database
- Mailer
...

Clone the project to download its contents in your project folder:
```
cd projects/
git clone https://github.com/prod3v3loper/five.git
```

Now make composer and npm install the project's dependencies into vendor/ and node_modules/
```
composer install
npm install
```

Create database and tables
```
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

Set a Admin in src/DataFixtures UserFixtures.php and fire this in console
```bash
php bin/console doctrine:fixtures:load
```
```php
    public function load(ObjectManager $manager) {
        $user = new User();
        $user->setUsername('yourusername');
        $user->setEmail('your@email');
        $user->setPassword($this->encoder->encodePassword($user, 'yourpassword'));

        $manager->persist($user);
        $manager->flush();
    }
```
Register function comes later...

To run build develop enter:
```
npm run dev
```
To run build production enter:
```
npm run build
```

To run symfony server:
```
symfony server:start
```