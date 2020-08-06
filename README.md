# UEFA

A platform to simulating UEFA competition system.

# Installation Guide:

- Clone the repo using `git clone git@github.com:rasadeghnasab/UEFA.git`
- cd UEFA
- Run `docker-compose up -d` and wait for process to finish. Note that you have to have docker and docker-composer installed.
- Run `docker-compose run --rm install` and wait for installation to finish.
- Run `docker-compose run --rm migrate`
- Run `docker-compose run --rm artisan db:seed` This step is optional it only seeds database with some real world data you use API endpoints instead.
    - It will create 32 teams.
    - A competition
    - A tournament for that competition
    - Schedule tournament matches
- The website now is accessable on this address: `http://uefa`
- After all the pieces fixed in their place you can 
    - Execute any match by replacing `schedule_id` in this URL `http://uefa/ap/v1/predict/match/{schedule_id}`
    - Or execute a level by sending `level` parameter to the following url usnig POST request. `http://uefa/api/v1/predict/competition/{competition_id}/level`
    - Level accepts these values in order: `group`, `roundSixteen`, `roundEight`, `semiFinal`, `classification`, `final`

- After each game completed you can check the results using schedules API endpoints