# NSE_Interview_Coding_Test

# Description

This repository contains the code for implementing user registration and login functionality along with file upload functionality. The project is structured with separate folders for controllers, models, and SQL scripts. The backend is built using core PHP and relies on stored procedures for managing database operations.

# Project Structure

**Controller:** The `Controller` folder contains two separate files, `RegisterController` and `LoginController`, each handling the respective functionalities. These controllers are responsible for receiving HTTP requests and interacting with the model to process the data.

**Model**: The `Model` folder contains common files used by both controllers. These files encapsulate the logic for interacting with the database and executing stored procedures.

**Documents**: The Documents folder is the designated location for storing uploaded files during the registration process.

**SQL_Scripts**: The `SQL_Scripts` folder holds the SQL scripts necessary for setting up the database. Inside this folder, you will find a script to create the required tables and stored procedures for both registration and login.

**Postman Collection**: The `Postman Collection` folder includes a Postman collection that you can import into your Postman workspace. This collection consists of API endpoints for testing user registration and login. Additionally, dummy data is provided within the collection for reference.

## Usage

1. **Database Setup**: Execute the SQL scripts in the `SQL_Scripts` folder to set up the required tables and stored procedures in your database.
2. **Controller Code**: Review the code in the `Controller` folder to understand the implementation of registration and login functionalities.
3. **Model Code**: Explore the common model files in the `Model` folder, which handle database operations.
4. **File Upload**: Uploaded files during registration will be stored in the Documents folder.
5. **Postman Testing**: Import the provided Postman collection from the `Postman Collection` folder. Use this collection to test the registration and login APIs with the included dummy data.

## Contact

If you encounter any issues, have questions, or need further assistance, feel free to contact me. I'm here to help!

**Author**: Vaibhav Khambayat
**Email**: vaibhavkhambayat27@gmail.com

Thank you!
