# Project Name

## Setup Instructions

1. **Clone the Repository:**
   ```bash
    git clone https://github.com/oguzhanT/myedspace-tutor-manager
2. **Change Directory:**
   ```bash
    cd myedspace-tutor-manager
3. **Install Dependencies:**
   ```bash
    composer install
4. **Create a copy of the `.env` file:**
5. **Start Laravel Sail (if using Docker):**
   ```bash
    ./vendor/bin/sail up
6. **Migrate:** 
   ```bash
     ./vendor/bin/sail migrate
7. **Seed:** 
   ```bash
     ./vendor/bin/sail artisan db:seed
8. **Run tests:** 
   ```bash
     ./vendor/bin/sail test
9. **Npm Install:** 
   ```bash
     npm install
10. **Npm Run Dev:** 
   ```bash
     npm run dev
 ```

## Assumptions Made During Development
- The API key for Dummy OpenEd API is provided in the environment file.
- Redis is configured and running for caching.
- Laravel Sail or Docker is used for the development environment.

## Design Decisions and Architectural Choices
- OpenEdApi: Created mock OpenEdApi service.
- Service Layer: Created OpenEdService to handle API interactions and caching, and RateUpdateService to handle rate updates.
- Livewire Component: Implemented TutorSearch for real-time searching and filtering.
- Database: Used MySql for the database.
- Redis: Used Redis for caching.
- Testing: Implemented feature tests for the API and unit tests for the services.
- Frontend: Used Tailwind CSS for styling and Livewire for real-time interactions.
- Pint: Used Pint for Code style checking.
- LaraStan: Used LaraStan for static analysis.


## Future Improvements and Scalability Considerations
- Enhanced Error Handling: Improve error handling and user notifications.
- Logging: Add logging for better debugging and monitoring.
- Sentry: Integrate Sentry for error tracking.
- Pagination: Implement pagination for large result sets like Tutor or Students.
- Elasticsearch: Implement Elasticsearch for searching and filtering.

## Running Tests and Checking Code Coverage
- Run Tests:

  ```bash
    ./vendor/bin/sail test
   ```
- Check Code Coverage:

  ```bash
  ./vendor/bin/phpunit --coverage-html coverage

  
## GitHub Repository URL
- [GitHub Repository](https://github.com/oguzhanT/myedspace-tutor-manager)


## Summary

While this task was challenging, I focused on demonstrating my strengths. Although design isn't my strongest area, I created a theme based on the colors from https://myedspace.co.uk/. The deployment was successfully done using Vapor, and you can test the application at this URL: https://xu3zn2rcm7xvjqyqjyp5p7z52q0mtfwz.lambda-url.eu-central-1.on.aws/.

I also integrated Auth0, but I encountered some issues with the guard integration. Additionally, I implemented Sentry integration for error tracking.

Thank you for the opportunity, and I look forward to your feedback!


## Short demo video
- [https://we.tl/t-kCGsQoqUgV](https://we.tl/t-kCGsQoqUgV)
