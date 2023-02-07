<a name="readme-top"></a>

[![Forks][forks-shield]][forks-url]
[![Issues][issues-shield]][issues-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://www.github.com/AhmedSobhy01/rental-payments-management-system">
    <img src="https://www.freepnglogos.com/uploads/logo-home-png/chimney-home-icon-transparent-1.png" alt="Logo" width="80" height="80">
  </a>

<h3 align="center">Rental Payment Management System</h3>

  <p align="center">
    A replicate of the official Instagram website with the ability to post images for the web application.
    <br />
    <a href="https://rpms.ahmedsobhy.net">View Demo</a>
    ·
    <a href="https://www.github.com/AhmedSobhy01/rental-payments-management-system/issues">Report Bug</a>
    ·
    <a href="https://www.github.com/AhmedSobhy01/rental-payments-management-system/issues">Request Feature</a>
  </p>
</div>

<!-- ABOUT THE PROJECT -->

## About The Project

[![Product Name Screen Shot][product-screenshot]](https://rpms.ahmedsobhy.net)

This is a property management system designed to assist landlords in tracking and setting payments for their tenants. It allows landlords to easily manage and record tenant payments, view payment history, and generate reports. Tenants can also access the system to view all of their dues and payments in one convenient location, ensuring transparency and accuracy in the payment process. The system is built using the Laravel framework, offering robust and scalable features to manage the entire rental process efficiently.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

-   [![Laravel][laravel.com]][laravel-url]
-   [![Vue][vue.js]][vue-url]
-   [![tailwind][tailwind.com]][tailwind-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- Installation -->

### Installation

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

1. Clone the repo
    ```sh
    git clone https://www.github.com/AhmedSobhy01/rental-payments-management-system.git
    ```
2. Install Composer packages
    ```sh
    composer install
    ```
3. Install NPM packages
    ```sh
    npm install
    ```
4. Copy .env.example and then edit .env
    ```sh
    cp .env.example .env
    ```
5. Generate app encryption key
    ```sh
    php artisan key:generate
    ```
6. Migrate and seed the database
    ```sh
    php artisan migrate:fresh --seed
    ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- USAGE EXAMPLES -->

## Usage

After seeding database, you can login using default user:
| **Email** | **Password** |
| --- | --- |
| test@test.com | password |

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTACT -->

## Contact

Ahmed Sobhy - contact@ahmedsobhy.net

Project Link: [https://www.github.com/AhmedSobhy01/rental-payments-management-system](https://www.github.com/AhmedSobhy01/rental-payments-management-system)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->

[forks-shield]: https://img.shields.io/github/forks/AhmedSobhy01/rental-payments-management-system.svg?style=for-the-badge
[forks-url]: https://github.com/AhmedSobhy01/rental-payments-management-system/network/members
[stars-shield]: https://img.shields.io/github/stars/AhmedSobhy01/rental-payments-management-system.svg?style=for-the-badge
[stars-url]: https://www.github.com/AhmedSobhy01/rental-payments-management-system/stargazers
[issues-shield]: https://img.shields.io/github/issues/AhmedSobhy01/rental-payments-management-system.svg?style=for-the-badge
[issues-url]: https://www.github.com/AhmedSobhy01/rental-payments-management-system/issues
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://www.linkedin.com/in/ahmed-sobhy-dev
[product-screenshot]: https://ahmedsobhy.net/storage/d1a5aae070737c5a0914dee0806b7a4a/Home.png
[vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[vue-url]: https://vuejs.org/
[laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[laravel-url]: https://laravel.com
[tailwind.com]: https://img.shields.io/badge/TailwindCSS-36B7F0?style=for-the-badge&logo=tailwindcss&logoColor=white
[tailwind-url]: https://tailwindcss.com
