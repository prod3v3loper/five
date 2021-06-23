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

Set a Admin in src/DataFixtures UserFixtures.php and fire this in console
```
php bin/console doctrine:fixtures:load
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