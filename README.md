# Coding Assignment

## Notes

- For demonstration purposes, I used web routes instead of api routes. I deactivated VerifyCsrfToken middleware 
- I left extra comments inside the code to explain my decisions, for e.g: in the migration files
- Checking if month-profile fraction already exists is on SQL side. I didn't check it for MeterReadings, although I think they should be
- I assumed that there's only one profile / incoming data. Meaning, that both Fractions and MeterReadings come in a pack of 12 months for one profile / request
- How I understood the exercise, MeterID for MeterReadings can't be unique as more than one record is stored for the same MeterID
- I tried to implement CQRS principles and for the most part I think I did it. It was my first time though, but it was very nice to get to know about it as I have not used it before. Thanks for initiating the research :)
- I did all validations and basic CRUD operations.
- I wrote 12 tests, with 41 assertions
- Due to time constraints, I didn't finish the following things:
  - Cronjob for resetting the meters
  - Proper documentation for the API – But I did comment the interface implementations. If I had more time, you'd receive either a generated one or one written by myself
  - Returning Consumption for a given meter

All in all, this is what I could do in 2 days. I think understanding the exercise took at least half of the time but once I decided how I'll interpret it and understood what this task wanted to accomplish,
the rest was just writing codes and tests. I would have wanted to finish up with everything, but Christmas is on 24th in Hungary and I had errands to run and also a blackout on 23rd evening :D
Hope this unfinished project demonstrates enough about my skills, consume it with good health! 

## Setup

1. Clone the repository in a desired folder and cd into it
2. Run `composer install` 
3. Run `npm install` 
4. Create the following databases for the project `coding_assignment` and `coding_assignment_unit_tests`
5. Configure `.env` file according to local environment (`DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
6. Run `php artisan config:clear && php artisan cache:clear` to clear cache – this is needed after any change in the `.env` file
7. Run `php artisan key:generate` to generate application key
8. TODO: Run `php artisan migrate` to run migrations

## Tests

Tests are in the `tests` folder. I only wrote unit tests, separated into their own folders by model type

1. cd into project folder
2. run `vendor/bin/phpunit --config=phpunit.local.xml`
