let mix = require('laravel-mix');

mix.js("resources/js/app.js", "app.js")
    .postCss("resources/css/app.css", "app.css", [
        require("tailwindcss"),
    ])
    .setPublicPath('resources/dist')
    .sourceMaps()
    .version()
    .disableNotifications();
