# Clinic Estrella de Jerusalén

A comprehensive web system developed using **HTML5**, **CSS3**, **JavaScript**, **PHP**, and **MySQL**, designed to optimize the **medical and administrative management** of the **Centro Médico Estrella de Jerusalén**. The platform centralizes **patient care**, **consultations**, and **resource management**, ensuring **efficiency**, **scalability**, and **security**.

---

## Table of Contents  
- [Project Description](#project-description)  
- [Features](#features)  
- [Prerequisites](#prerequisites)  
- [Installation](#installation)  
- [Usage](#usage)  
- [Contributions](#contributions)  
- [License](#license)  
- [Contact](#contact)  

---
## Project Description  
The **Clinic Estrella de Jerusalén Web System** is a digital solution for modernizing **healthcare processes**. It replaces traditional **paper-based management** with a centralized, **secure**, and **scalable** web platform.

The system provides three main roles:  
- **Patients**: Can register, request appointments, review medical history, and access services.  
- **Doctors**: Record consultations, diagnoses (**ICD-10 coding**), medical exams, and generate PDF reports.  
- **Administrators**: Manage users, patient records, medical specialties, schedules, and internal resources.

The system ensures:  
- **Role-based authentication and authorization**.  
- **Data validation and SQL injection protection**.  
- **Encrypted password storage**.  
- A **responsive design** compatible with both desktop and mobile devices.  
- Integration with **Google Maps** for clinic location and **dynamic document generation**.

---

## Features  
- ✔️ **Product Management**: Registration, consultation, and update of **personal and medical data**.  
- ✔️ **Sales Management**: Recording of **consultations, diagnoses, exams, and treatments**.  
- ✔️ **Graphical User Interface (GUI)**: Real-time **availability validation**, **rescheduling**, and **cancellations**.  
- ✔️ **Parallel Data Processing**: Specialties such as **cardiology**, **pediatrics**, **nutrition**, **internal medicine**, etc.  
- ✔️ **Performance Analysis**: Manage **patients**, **doctors**, **specialties**, and **services**.  
- ✔️ **Database Integration**: Relational structure designed in **MySQL** and managed with **XAMPP**.

---

## Prerequisites  
1. **Read the attached PDF file: "Read before compiling the project".**  
2. **XAMPP**: Download and install from [https://www.apachefriends.org/](https://www.apachefriends.org/)  
3. **PHP**: Included with **XAMPP** (latest stable version recommended)  
4. **MySQL**: Installed and managed through **XAMPP**.  
5. **Browser**: A modern browser (**Chrome**, **Firefox**, **Edge**).

---

## Installation  
Follow these steps to install and run the project on your local machine:

1. **Clone the repository:**  
    ```bash
    git clone https://github.com/gianpaaul/clinic-estrella-jerusalen.git
    ```

2. **Move project files to the XAMPP `htdocs` folder:**  
    ```
    C:/xampp/htdocs/clinic-estrella-jerusalen
    ```

3. **Configure the Database in XAMPP:**  
    3.1 **Start XAMPP** and activate **Apache** and **MySQL** modules.  
    3.2 Open **phpMyAdmin**.  
    3.3 Create a database named **clinic**.  
    3.4 Import the provided **clinic.sql** file from the repository.

4. **Final Configuration:**  
    4.1 Check database connection settings in the PHP configuration file (usually `config.php` or similar).  
    4.2 **Default settings:**  
    ```
    Host: localhost  
    User: root  
    Password: (empty by default unless configured otherwise)  
    Database: clinic
    ```

5. **Run the Project:**  
    Open your browser and go to:  
    ```
    http://localhost/clinic-estrella-jerusalen
    ```
    
---
## Contributions
Contributions are welcome! Here's how you can contribute:

1. **Fork the repository.**  
2. **Create your branch:**  
    ```bash
    git checkout -b feature/NewFeature
    ```  
3. **Make your changes and commit:**  
    ```bash
    git commit -m 'Add new feature'
    ```  
4. **Push to your branch:**  
    ```bash
    git push origin feature/NewFeature
    ```  
5. **Open a pull request.**

---

## Contact  
GitHub: [https://github.com/gianpaaul](https://github.com/gianpaaul)
