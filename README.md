<div align="center">
  <img src="https://via.placeholder.com/150x150.png?text=MINDCRAFT" alt="MINDCRAFT-EXPO Logo" width="150" height="150">

  # MINDCRAFT-EXPO

  ### AI-Powered Learning & Mentorship Platform

  <p align="center">
    <a href="#overview">Overview</a> •
    <a href="#key-features">Key Features</a> •
    <a href="#technology-stack">Tech Stack</a> •
    <a href="#installation">Installation</a> •
    <a href="#architecture">Architecture</a>
  </p>

  ![Laravel](https://img.shields.io/badge/Laravel-11.0-FF2D20?style=flat-square&logo=laravel)
  ![Filament](https://img.shields.io/badge/Filament-3.3-4F46E5?style=flat-square)
  ![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square&logo=php)
  ![MySQL](https://img.shields.io/badge/MySQL-latest-4479A1?style=flat-square&logo=mysql)
</div>

## 🔍 Overview

MINDCRAFT-EXPO is a revolutionary educational platform that leverages artificial intelligence to create personalized learning experiences. The platform connects mentors and mentees through AI-recommended learning paths, creating tailored educational journeys for each student.

<div align="center">
  <img src="https://via.placeholder.com/800x400.png?text=MINDCRAFT-EXPO+Dashboard" alt="Platform Screenshot">
</div>

## ✨ Key Features

### 🤖 AI Integration
- **Smart Course Recommendations** - AI algorithms match students with perfect courses
- **Mentor Matching** - Find the ideal mentor based on learning style and goals
- **Content Generation** - AI-powered creation of learning materials and activities
- **Custom Learning Paths** - Personalized learning journeys for each student

### 👨‍🏫 Comprehensive Mentoring
- **Multi-faceted Mentorship** - Direct connection between mentors and mentees
- **Progress Tracking** - Real-time monitoring of student development
- **Interactive Feedback** - Essay submissions with detailed mentor feedback
- **Q&A System** - Direct question and answer functionality

### 📊 Advanced Analytics
- **Learning Style Analysis** - Identify and adapt to individual learning preferences
- **Strength/Weakness Detection** - Pinpoint areas for improvement
- **Insight Reports** - Detailed analytics on course effectiveness
- **Performance Metrics** - Track progress across all learning activities

### 💼 Professional Platform
- **Integrated Payments** - Secure course purchase and subscription management
- **Multi-panel Interface** - Separate dashboards for Admin, Mentor, and Mentee
- **Hierarchical Content** - Organized learning with Categories, Courses, Units, and Lessons
- **Multi-format Resources** - Support for text, video, quiz, and assignment content types

## 🛠️ Technology Stack

<table>
  <tr>
    <td align="center" width="96">
      <img src="https://cdn.worldvectorlogo.com/logos/laravel-2.svg" width="48" height="48" alt="Laravel" />
      <br>Laravel 11
    </td>
    <td align="center" width="96">
      <img src="https://avatars.githubusercontent.com/u/71972937" width="48" height="48" alt="Filament" />
      <br>Filament 3.3
    </td>
    <td align="center" width="96">
      <img src="https://cdn.worldvectorlogo.com/logos/mysql-6.svg" width="48" height="48" alt="MySQL" />
      <br>MySQL
    </td>
    <td align="center" width="96">
      <img src="https://livewire-framework.com/img/twitter.png" width="48" height="48" alt="Livewire" />
      <br>Livewire
    </td>
  </tr>
</table>

## 🚀 Installation

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js & NPM

### Setup Steps

1. **Clone the repository**
```bash
git clone https://github.com/AlmaNurulSalma-dev/mindcraft.git
cd mindcraft

Install dependencies

bashcomposer install
npm install

Environment setup

bashcp .env.example .env
php artisan key:generate

Configure database in .env file

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mindcraft_expo
DB_USERNAME=root
DB_PASSWORD=

Run migrations and seeders

bashphp artisan migrate --seed

Compile assets

bashnpm run build

Start the development server

bashphp artisan serve
Visit http://127.0.0.1:8000 to access the application.
🔑 Demo Accounts
After running seeders, you can log in with the following demo accounts:
RoleEmailPasswordAdminadmin@mindcraft.compasswordMentormentor@mindcraft.compasswordStudentstudent@mindcraft.compassword
🏗️ Architecture
MINDCRAFT-EXPO follows a multi-panel architecture with role-based access control:
MINDCRAFT-EXPO
│
├── Admin Panel (/admin)
│   ├── User Management
│   ├── Course & Category Management
│   ├── AI Model Configuration
│   └── System Settings
│
├── Mentor Panel (/mentor)
│   ├── Course Management
│   ├── Student Progress Tracking
│   ├── Assignment Grading
│   └── Insight Reports
│
└── Mentee Panel (/mentee)
    ├── Course Enrollment
    ├── Learning Dashboard
    ├── Assignment Submission
    └── Mentor Communication
Data Structure

Category → Course → Unit → Lesson
User → StudentProfile / Mentor
LearningPath → LearningPathItem
AI Components: LlmModel, PromptTemplate, AiGeneratedContent

📱 Screenshots
<div align="center">
  <img src="https://via.placeholder.com/250x150.png?text=Admin+Dashboard" width="250">
  <img src="https://via.placeholder.com/250x150.png?text=Mentor+Panel" width="250">
  <img src="https://via.placeholder.com/250x150.png?text=Student+Dashboard" width="250">
</div>