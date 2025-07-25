# 🎓 Classique – Web-Based Classroom Management System

**Classique** is a simple yet functional online classroom platform built for managing courses, batches, students, and teachers in one unified space. Designed for academic environments, it focuses on streamlining the core interactions between teachers and students — from course planning to assignment tracking and mark evaluation.

---

## 🌐 About the Project

This project was created to demonstrate how basic web technologies can power a digital classroom system. With separate interfaces for teachers and students, Classique helps manage classroom workflows such as:

- Viewing and managing course batches
- Assigning course plans and assignments
- Showing student lists with Class Representative (CR) info
- Allowing students to view assignments and their marks

---

## 🛠️ Built With

- **Frontend:** HTML, CSS, Bootstrap, JavaScript (minimal)
- **Backend:** PHP
- **Database:** MySQL

---

## ✨ Key Features

- 🔐 **Role-Based Login System** – Separate dashboards for teachers and students  
- 🏫 **Course & Batch Handling** – Courses can have multiple batches with student lists  
- 📝 **Assignment Management** – Upload, edit, and delete assignments  
- 📅 **Course Planning** – Teachers can schedule tutorials, presentations, and viva dates  
- 📤 **Resource Sharing** – Upload course resources for students  
- 📊 **Marks Evaluation** – Teachers can submit marks, and students can view them in their portal  

---

## 📁 Project Structure (Important Files)

```plaintext
|-- login.php / logout.php / loginAction.php
|-- registerFirstPage.php / studentRegister.php / teacherRegister.php
|-- home.php / studentHome.php / teacherHome.php / batchHome.php
|-- addCourseDetails.php / update_course.php / delete_course.php
|-- saveAssignment.php / update_assignment.php / delete_assignment.php
|-- resourceAction.php / update_resource.php / delete_resource.php
|-- addTutorialDates.php / update_dates.php / delete_dates.php
|-- addPresentationAction.php / addVivaAction.php
|-- student_course_show.php / student_add_course.php
|-- config.php (MySQL database connection)

```

---
## ⚙️ How to Run the Project


📦 Install XAMPP on your system.

▶️ Start both Apache and MySQL from the XAMPP control panel.

🗃️ Import the MySQL database into phpMyAdmin (usually at http://localhost/phpmyadmin).

📂 Place this project folder (classique) inside the htdocs/ directory.

🌐 Open your browser and go to:
http://localhost/classique/

---


## 🎯 Intended Use


This system is built primarily for:

- Academic project submission

- Demonstrating database-driven websites

- Understanding core PHP-based web development

- Prototyping a lightweight LMS (Learning Management System)

---


## 🙋‍♂️ Developer Note


This project avoids the use of advanced frameworks or third-party tools to keep everything transparent and beginner-friendly. It's perfect for learning how frontend and backend can work together using only core technologies.


---


##📬 Contact

Feel free to use, modify, or improve this project. If you liked the idea or want to contribute, you’re welcome to fork and enhance it.


---

