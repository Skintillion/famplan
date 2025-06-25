# Famplan 🏠

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com/)
[![Vue.js](https://img.shields.io/badge/Vue.js-3-green.svg)](https://vuejs.org/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-blue.svg)](https://tailwindcss.com/)

**The complete family organization solution you can host yourself - completely free and open source.**

Famplan is a comprehensive family planning and organization platform designed to help families manage their daily lives, health, and household responsibilities. With support for TV touchscreen displays, mobile devices, and traditional desktop interfaces, Famplan adapts to how your family actually lives.

🌐 **Hosted Version**: [famplan.ca](https://famplan.ca)

## ✨ Features

### 📊 Health & Nutrition
- **Nutrition Tracking** - Log meals, track macros, and monitor nutritional intake
- **Weight Management** - Track weight changes and set health goals
- **Calorie Counting** - Comprehensive diet tracking with food database
- **Progress Visualization** - Charts and graphs to visualize health trends

### 🏠 Household Management
- **Chore Management** - Assign, track, and manage household tasks
- **Family Calendar** - Shared scheduling for all family members
- **Task Assignment** - Distribute responsibilities fairly among family members
- **Progress Tracking** - See who's completing their tasks and when

### 📺 Multi-Interface Support
- **TV Touchscreen Mode** - Perfect for wall-mounted displays in kitchens or common areas
- **Mobile Responsive** - Full functionality on phones and tablets
- **Desktop Interface** - Complete management from your computer
- **Cross-Device Sync** - Start on your phone, finish on the TV

### 🔒 Privacy & Control
- **100% Self-Hosted** - Your family's data stays on your server
- **Open Source** - Full transparency and community-driven development
- **No Subscriptions** - Free forever, no hidden costs
- **Data Ownership** - You control your information completely

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- Node.js 18+
- MySQL/PostgreSQL
- Composer
- npm/yarn

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/famplan.git
   cd famplan
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your database**
   Edit `.env` with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=famplan
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access your Famplan installation!

## 🖥️ TV Touchscreen Setup

For the optimal family experience, mount a touchscreen display in your kitchen or common area:

1. **Recommended Hardware**
   - 10-32" touchscreen display
   - Raspberry Pi 4 or mini PC
   - Wall mount bracket

2. **Browser Setup**
   - Use Chrome/Firefox in kiosk mode
   - Navigate to your Famplan installation
   - The interface automatically adapts for touch interaction

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP)
- **Frontend**: Vue.js 3 with Composition API
- **Styling**: Tailwind CSS
- **Database**: MySQL/PostgreSQL/SQLite
- **Build Tools**: Vite
- **Authentication**: Laravel Sanctum

## 📱 Mobile App

While Famplan works perfectly in any mobile browser, we're also developing native mobile apps for enhanced offline functionality and push notifications.

## 🤝 Contributing

We welcome contributions from the community! Whether it's bug fixes, new features, or documentation improvements.

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Setup

```bash
# Start development servers
npm run dev          # Frontend assets
php artisan serve    # Backend API

# Run tests
php artisan test     # Backend tests
npm run test         # Frontend tests
```

## 📋 Roadmap

- [ ] Recipe management and meal planning
- [ ] Shopping list generation
- [ ] Family budget tracking
- [ ] Kids' allowance management
- [ ] Medication reminders
- [ ] Pet care tracking
- [ ] Home maintenance schedules
- [ ] Native mobile apps (iOS/Android)
- [ ] Voice assistant integration
- [ ] Smart home device connectivity

## 🐛 Bug Reports & Feature Requests

Please use the [GitHub Issues](https://github.com/yourusername/famplan/issues) page to report bugs or request new features. When reporting bugs, please include:

- Your PHP and Node.js versions
- Steps to reproduce the issue
- Expected vs actual behavior
- Screenshots if applicable

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 💖 Support the Project

If Famplan helps your family stay organized, consider:

- ⭐ Starring this repository
- 🐛 Reporting bugs or suggesting features
- 🤝 Contributing code or documentation
- 💬 Sharing with other families who might benefit

## 🔗 Links

- **Website**: [famplan.ca](https://famplan.ca)
- **Documentation**: [Wiki](https://github.com/yourusername/famplan/wiki)
- **Community**: [Discussions](https://github.com/yourusername/famplan/discussions)
- **Security**: [Security Policy](SECURITY.md)

---

**Made with ❤️ for families who want to stay organized without sacrificing their privacy.**
