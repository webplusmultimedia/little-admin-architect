let mix = require('laravel-mix');

mix.js("resources/js/app.js", "dist")
    .postCss("resources/css/app.css", "app.css", [
        require("tailwindcss"),
    ])
    .setPublicPath('dist')
    .disableNotifications();
