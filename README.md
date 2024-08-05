# Wander-Japan
- This web application provides comprehensive information about various cities in Japan, focusing on weather forecasts and popular places to visit. Utilizing the Foursquare and OpenWeather APIs, users can access up-to-date weather data and detailed information about attractions in different cities, ensuring an informative and user-friendly experience.

## What Makes My Code Implementation Stand Out?

### Server Side
- **Laravel Framework**: Utilized Laravel, a robust PHP MVC framework, to create a microservice API that efficiently handles API calls and data fetching. This ensures a scalable and maintainable backend architecture.
- **API Integration**: Integrated the Foursquare and OpenWeather APIs to fetch relevant location and weather data, providing users with accurate and up-to-date information.
- **Single Responsibility Principle**: Adhered to the Single Responsibility Principle by ensuring each class has a distinct responsibility. Controllers handle HTTP requests exclusively, while service helpers manage business logic, leading to cleaner, more maintainable code.
- **PSR Standards Compliance**: Followed PSR-1, PSR-2, PSR-4, and PSR-12 coding standards to ensure clean, consistent, and well-structured code. This adherence enhances readability and maintainability.
- **Clean Code Practices**: Implemented clean code principles, emphasizing readability, simplicity, and modularity. This results in a codebase that is easy to understand and extend.
- **Comprehensive Documentation**: The codebase is thoroughly documented with comments, providing clear explanations of functionality. This facilitates easier collaboration and onboarding of new developers.

### Client Side
- **Vue.js Framework**: Leveraged Vue.js to build the application with a component-based architecture, promoting modularity and ease of maintenance. This approach ensures that each part of the application is encapsulated and manageable.
- **Scoped CSS**: Employed scoped CSS to encapsulate styles within individual components, preventing style conflicts across the application and maintaining a consistent design.
- **Responsive Design with Media Queries**: Utilized media queries to ensure the application is responsive, adapting the layout and styling for different screen sizes to provide an optimal user experience on all devices.
- **Efficient Rendering Techniques**: Used Flexbox for layout and efficient CSS practices to ensure quick rendering and high performance, even on devices with limited resources.
- **Consistent Naming Conventions**: Adopted consistent naming conventions for classes and variables, enhancing code readability and maintainability across the development team.

## Why I Chose This UI and UX Implementation
- **3-Click Rule**: Designed the user interface to ensure users can access the information they need with minimal clicks, enhancing usability and efficiency.
- **Temperature Unit Switch**: Added functionality for users to switch between Celsius and Fahrenheit temperature units, catering to different user preferences and enhancing the overall user experience.
- **Image Zoom Feature**: Included an image zoom capability to allow users to examine pictures in greater detail, improving the visual experience and user engagement.
- **Bootstrap Framework**: Selected Bootstrap for its robust grid system, which significantly aids in creating a responsive web application. This ensures the interface is adaptable to various screen sizes.
- **Remix-Icon Library**: Incorporated the Remix Icon library for a uniform and visually appealing iconography throughout the application, enhancing the overall user interface.
- **Responsive Design with Media Queries**: Implemented media queries to adjust the layout and styling for different screen sizes, ensuring a responsive and user-friendly design.
- **Accessibility Features**: Ensured the navigation bar remains visible during scrolling, allowing users to easily switch between cities or sections without losing their place, enhancing overall accessibility.
- **Loading Indicators**: Integrated loading spinners to provide users with visual feedback during data loading processes, preventing confusion and improving the user experience.

## How to run
1. Clone the repository from GitHub
2. Open a terminal or command line and change directory to the project directory
3. run command 'composer update'
4. run command 'npm install'
5. run command 'npm run dev'
6. run command 'php artisan key:generate' to generate the app key
6. run command 'php artisan serve' and use the generated URL address(ex. http://127.0.0.1:8000) by this command to open it in the browser
