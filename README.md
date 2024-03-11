# Task Manager Application

This is a simple task manager application built with Laravel. It allows users to create, manage, and prioritize tasks within different projects.

## Setup

### Requirements

-   PHP (>=8.1)
-   Composer
-   Node.js
-   npm or Yarn
-   MySQL or another compatible database

### Installation

1. Clone the repository:

    ```bash
    Unzip the folder into your workarea
    ```

2. Navigate into the project directory:

    ```bash
    cd task-manager / project
    ```

3. Install PHP dependencies with Composer:

    ```bash
    composer install
    ```

4. Install JavaScript dependencies with npm:

    ```bash
    run npm install

    run npm run dev when on local or in development
    run npm run build fpr production
    ```

5. Create a copy of the `.env.example` file and rename it to `.env`. Update the database and other configuration settings as needed:

    ```bash
    cp .env.example .env

    Update database connection
    Update the email smtp for password reset and verification if needed.
    ```

6. Generate an application key:

    ```bash
    php artisan key:generate
    ```

7. Run database migrations to create the necessary tables:

    ```bash
    php artisan migrate
    ```

### Usage

1. Start the development server:

    ```bash
    php artisan serve
    ```

2. Access the application in your web browser at `http://localhost:8000`.

3. You can now create projects and tasks, prioritize tasks, and manage them within the application.

### Deployment

To deploy the application to a production environment:

1. Configure your web server (Apache, Nginx) to serve the application from the `public` directory.

2. Update the `.env` file with production settings, including database credentials, environment variables, and any other necessary configurations.

3. Ensure that necessary permissions are set for files and directories, and that appropriate security measures are in place (mainly to the storage directory).

4. Deploy the application code to your production server using your preferred method (Git, FTP, etc.).

5. Run database migrations and any necessary commands on the production server.

6. Test the deployed application thoroughly to ensure it's working as expected in the production environment.

### Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.

### License

This project is open-source and available under the [MIT License](LICENSE).
