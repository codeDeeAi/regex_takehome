## Setup

1. Clone repository
2. Navigate to the ``backend`` folder and run commands
    1. `` composer install ``
    2. `` npm install ``
    3. Set up database credentials and run ``php artisan migrate``
    4. ``php artisan serve``
3. In ``frontend`` folder
    1. run ``npm install``
    2. create ``.env`` file and add ``VITE_API_HOST=backend_host_url`` e.g ``http://127.0.0.1:8000/ ``to connect to backend
    3. Run server with ``npm run dev``

 