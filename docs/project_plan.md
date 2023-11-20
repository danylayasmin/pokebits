# Deep Dive: Pokémon Data Backend Database & API.

🎯 **Purpose:**
The project aims to create an easy-to-use, robust, and well-documented API to give seamless access to Pokémon data. Our primary objectives include not only providing access but ensuring ease of use through comprehensive documentation, efficient data filtering, and caching. By offering a user-centric API, we aim to empower other developers to effortlessly integrate Pokémon data into their applications, without them having to worry about their own caching solutions. Our data comes from PokeAPI; this can be used by anyone however they require you to locally cache resources as you request them. This is understandable but could be tough if you're a pure frontend developer. Pokebits periodically checks the PokeAPI and populates our own database with all the data. We also will do all the caching for you. Meaning you can focus on your front-end project, without having to worry about breaking PokeAPI their fair-use policy.

🔍 **Scope:**

**Will:**

-   Provide a user-friendly and accessible API interface for getting Pokémon data.
-   Implement robust filtering mechanisms for efficient and specific data.
-   Develop comprehensive documentation that simplifies API usage and integration.
-   Generate OpenAPI Spec documentation to ensure clarity and ease of adoption.
-   Provide Postman Collections for quick integration and streamlined usage.
-   Explore potential integrations with frontend applications and data dashboards for enhanced user experiences.

**Won't:**

-   Engage in web scraping activities for data gathering; instead, data will be sourced from PokeAPI and stored in our database for serving purposes.
-   Limit data access to English language-only, ensuring uniformity and simplicity.
-   Develop user accounts or authentication systems, focusing solely on providing data access.
-   Build a separate dashboard, as the project solely focuses on backend development.

📝 **User Stories and Tasks:**  
Detailed user stories and task breakdowns will be meticulously outlined in subsequent phases, aligning with the project's objectives.

💻 **Technologies:**

-   **Development:**

    -   **PHP:** Chosen for the backend as we will also use Laravel.
    -   **MySQL:** Optimal for data storage, retrieval, and management within the relational database paradigm.
    -   **Laravel Framework:** Utilizing the Laravel framework for its powerful abstractions, facilitating rapid development and clean, maintainable code. This will allow us to ship the product much faster opposed to plain PHP.
    -   **EloquentORM:** Leveraging EloquentORM for simplified and expressive database interactions.
    -   **Intervention Image:** Integration of Intervention Image for efficient handling and manipulation of Pokémon images. For example, we will use this to get the average Pokemon color as requested by our project owner.

-   **Deployment & Monitoring:**
    -   **Nginx:** Selected for web server deployment.
    -   **Cloudflare:** Utilizing Cloudflare as a content delivery network (CDN) for enhanced performance and security.
    -   **Laravel Telescope:** Implementation of Laravel Telescope for real-time monitoring, allowing insight into requests, responses, and system performance metrics.

🗃️ **Database Design:**  
Work in progress, will be added to this document later.

📅 **Planning:**  
Work in progress, will be added to this document later.

🖼️ **Wireframe:**  
As a backend-centric project, wireframing is not applicable in this context, focusing solely on API and database design.

---

_***TLDR***:
We're creating an easy-to-use Pokémon data API with robust filtering, good documentation, and caching. We'll pull data from PokeAPI, store it ourselves, and handle caching so developers can focus on their front-end. No scraping, only English data, no user accounts or dashboards. Using PHP, Laravel, MySQL, and other tech for development, deployment, and monitoring. Detailed planning and wireframing not relevant for this backend-focused project._
