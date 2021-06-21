/*
 * Welcome to your app's main TypeScript file!
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/global.scss';
import './styles/app.scss';

// start the Stimulus application
// import './bootstrap';

const $ = require('jquery');

$(document).ready(function() {
    console.log('Hello Webpack Encore! Edit me in assets/app.ts');
});