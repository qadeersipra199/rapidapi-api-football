# RapidAPI Football API

This package is designed to call all the endpoints of the football API available on RapidAPI.

## Installation

Follow the steps below to install and use the package:

1. **Add the repository in `composer.json`**:

    ```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/qadeersipra199/rapidapi-api-football"
        }
    ],
    ```

2. **Add the package to the `require` section in `composer.json`**:

    ```json
    "require": {
        "rapidapi/football-api": "master"
    }
    ```

3. **Add the autoload entry in the `autoload` section inside `composer.json`**:

    ```json
    "autoload": {
        "psr-4": {
            "Rapidapi\\FootballApi\\": "src/"
        }
    }
    ```

4. **Set the minimum stability to `dev` in `composer.json`**:

    ```json
    "minimum-stability": "dev"
    ```

5. **Register the service provider in `config/app.php`**:

    ```php
    'providers' => [
        // Other service providers...

        Rapidapi\FootballApi\FootballApiServiceProvider::class,
    ],
    ```

6. **Basic Usage**:

    ```php
    use Rapidapi\FootballApi\FootballApi;

    Route::get('/test', function () {
        $response = FootballApi::fixtures(1);
    });
    ```

7. **Environment Variables**:

    Add the following lines to your `.env` file:

    ```dotenv
    RAPID_API_FOOTBALL_API_HOST=RAPID_API_HOST
    RAPID_API_FOOTBALL_API_KEY=YOUR_API_KEY
    RAPID_API_FOOTBALL_API_URL=YOUR_URL
    ```

8. **Publish the Configuration File**:

    Run the following command to publish the configuration file:

    ```bash
    php artisan vendor:publish
    ```

    Select `Rapidapi\FootballApi\FootballApiServiceProvider` from the list. This will create a `footballapi.php` configuration file in your `config` folder.

## License

This project is licensed under the MIT License.
