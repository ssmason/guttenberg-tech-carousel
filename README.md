# Tech Icons Carousel - WordPress Gutenberg Block

## 📌 Description

**Tech Icons Carousel** is a custom Gutenberg block designed for WordPress, displaying a dynamic carousel of tech-related icons using Swiper.js. The block fetches icons from a **Custom Post Type (CPT)** and showcases them in a responsive, interactive slider.

## ✨ Features

- ✅ **Custom Gutenberg block** for easy insertion
- 🔄 **Fetches icons dynamically** from a WordPress CPT
- 🎡 **Uses Swiper.js** for smooth carousel functionality
- 📱 **Responsive and customizable** layout
- ⚡ **Optimized performance** using `render_callback`

## 📥 Installation

### **Step 1: Upload the Plugin**
Copy the plugin folder into:
```bash
wp-content/plugins/
```

### **Step 2: Activate the Plugin**
Go to **WordPress Admin → Plugins** and activate `Tech Icons Carousel`.

### **Step 3: Register Icons**
Add new tech icons under the **Tech Icons CPT (Custom Post Type)**.

### **Step 4: Insert Block**
In the WordPress block editor, search for **Tech Icons Carousel** and insert it into your post/page.

## 🛠 Usage

### **🏗 Adding Icons**
- Navigate to **Admin → Tech Icons**.
- Add a new **tech icon post** with a title and featured image.

### **🖼 Using the Carousel**
- Open any **page or post** in Gutenberg.
- Click `+` and search for **Tech Icons Carousel**.
- Insert and **publish**.

## 💻 Technical Details

### **📦 Gutenberg Block Registration**
The block is registered via `block.json` and enqueued using:
```php
register_block_type();
```

### **🎡 JavaScript (Swiper.js Initialization)**
```js-script
document.addEventListener("DOMContentLoaded", function () {
    new Swiper('.swiper-container', {
        loop: true,
        autoplay: { delay: 3000 },
        slidesPerView: 3,
        spaceBetween: 20,
        pagination: { el: '.swiper-pagination', clickable: true },
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }
    });
});
```

### **🌐 REST API Endpoint (if using dynamic fetching)**
```js-script
fetch('/wp-json/tech-carousel/v1/icons/')
    .then(response => response.json())
    .then(data => {
        console.log(data);
    });
```

## 🔧 Development & Build

### **Install Dependencies**
To set up the development environment, run:
```bash
npm install
```

### **Build the Project**
To build the block for production, use:
```bash
pnpx wp-scripts build
```

### **Development Mode**
For live reloading during development, use:
```bash
pnpx wp-scripts start
```

## 🎨 Customization

- 🎨 **Modify styles** in `tech-carousel.css`.
- ⚙️ **Change Swiper settings** in `tech-carousel.js`.
- 🏗 **Modify block structure** in `block.json`.

## 📝 Changelog

### **📌 Version 1.0.0**
- 🚀 **Initial release** with dynamic CPT-based carousel

## ⚖ License

This plugin is licensed under the **[MIT License](LICENSE)**.

## 👨‍💻 Author

Developed by **Steve Mason**.

