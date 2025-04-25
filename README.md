# 🚦 GH Monitor – Real-Time CI/CD Dashboard for GitHub Actions

GH Monitor is a Laravel + Vue-powered DevOps dashboard that visualizes your GitHub Actions workflows in real time. Built for developers and teams who want a clean, elegant view of their build pipelines — with live updates, historical analytics, and OAuth-secured repo insights.

![screenshot](https://your-screenshot-link.png)

---

## ⚡ Features

- ✅ **GitHub OAuth Login** – Secure sign-in using your GitHub account
- 🔁 **Real-Time Build Updates** – Powered by Laravel Echo + Pusher
- 📊 **Workflow Analytics** – Track build durations and outcomes
- 📦 **Repo Insights** – Monitor builds across multiple repositories
- 🕵️ **Event Logs** – Raw webhook payloads saved for auditing/debugging
- 🎨 **Vue + Tailwind UI** – Sleek, responsive dashboard design

---

## 🛠️ Tech Stack

| Layer     | Tools Used                          |
|-----------|--------------------------------------|
| Backend   | Laravel 11, Sanctum, Pusher, Horizon |
| Frontend  | Vue 3 (Composition API), TailwindCSS |
| Realtime  | Laravel Echo + Pusher                |
| Auth      | GitHub OAuth via Laravel Socialite   |
| Data      | MySQL/Postgres + Eloquent ORM        |
| Hosting   | Laravel Forge / Docker / Vercel      |

---

## 🚀 Getting Started

### 1. Clone the repo

```bash
git clone https://github.com/your-username/gh-monitor.git
cd gh-monitor
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Set up environment

```bash
cp .env.example .env
php artisan key:generate
```

Add your GitHub and Pusher credentials in `.env`:

```env
GITHUB_CLIENT_ID=xxx
GITHUB_CLIENT_SECRET=xxx
PUSHER_APP_ID=xxx
PUSHER_APP_KEY=xxx
PUSHER_APP_SECRET=xxx
PUSHER_APP_CLUSTER=xxx
```

### 4. Run migrations

```bash
php artisan migrate
```

### 5. Start the app

```bash
php artisan serve
npm run dev
```

---

## 📬 GitHub Webhook Setup

1. Go to your repo → Settings → Webhooks
2. Payload URL: `https://your-app.com/api/github/webhook`
3. Content type: `application/json`
4. Secret: match `.env`
5. Events: ✅ `workflow_run`, ✅ `check_suite`

---

## 📈 Dashboard Preview

- View build status in real time
- Analyze build duration over time
- Filter by repository, status, and date
- Customize themes and layout

---

## 🙋 Contributing

PRs welcome! If you have ideas for features like Slack alerts, dark mode, or advanced filtering, feel free to fork and submit.

---

## 🔒 License

MIT — free for personal and commercial use. Contributions welcome!

---

> Crafted with ❤️ by [Hans Bacares](https://github.com/hbacares)