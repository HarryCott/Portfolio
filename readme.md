Fake Page Builder (ACF-Inspired WordPress Plugin)

A lightweight custom WordPress plugin that replicates simplified page-builder functionality using dynamic sections, custom meta boxes, and front-end rendering — without relying on Elementor, Divi, or ACF.

This project was built as a portfolio piece to demonstrate understanding of:

WordPress plugin architecture

Custom meta boxes

Dynamic admin UI with JavaScript

Media uploader integration

Secure data handling & sanitisation

Frontend rendering via modular PHP sections

🚀 Project Goal

To create a modular “fake page builder” system that allows users to:

Add multiple content sections to a page

Reorder or remove sections

Customize styling per section

Add background colors or images

Dynamically render structured layouts on the frontend

This simulates the core logic behind commercial builders like Divi or Elementor — but built from scratch using native WordPress functionality.

🧱 Features
Section Types

Hero Section

Custom heading tag (h1–h6)

Font size control

Text colour

Background colour OR background image toggle

Content field

Text Section

Heading

Paragraph content

Text colour

Font size

Background options

Image + Text Section

Media uploader integration

Dynamic image preview in admin

Frontend image rendering

Customisable content styling

🛠 Technical Highlights
1️⃣ Custom Meta Box System

Built using add_meta_box

Sections stored as serialized arrays in post meta

Fully dynamic section creation via JavaScript

2️⃣ WordPress Media Uploader Integration

Uses wp.media

Dynamically updates preview thumbnail

Allows image replacement without deleting section

3️⃣ Secure Data Handling

Uses:

esc_html()

esc_attr()

esc_url()

intval()

Validates heading tags against allowed values

Prevents malformed HTML output

4️⃣ Modular Rendering System

Each section type renders via its own PHP file:

/sections/
    hero.php
    text.php
    image-text.php


Sections are loaded dynamically based on stored section type.

📂 File Structure
fake-page-builder/
│
├── fake-page-builder.php
├── admin/
│   ├── metabox.php
│   ├── save.php
│   └── admin.js
│
├── sections/
│   ├── hero.php
│   ├── text.php
│   └── image-text.php
│
└── assets/
    └── styles.css

💡 Why This Project Matters (Portfolio Value)

This project demonstrates:

Understanding of WordPress internals

Plugin development from scratch

Admin UI interactivity with JavaScript

Debugging complex data flow issues

Media handling without external frameworks

Modular backend architecture

It proves capability beyond “theme customisation” — showing actual WordPress engineering.

📦 Installation (Local Development)

Clone the repo

Place the plugin folder inside:

wp-content/plugins/


Activate in WordPress admin

Edit any page and use the custom "Page Sections" meta box

🧠 Future Improvements

Drag & drop section ordering

Repeater-style UI refinement

Live preview in admin

Gutenberg block version

REST API support

Section templates

Section duplication button

🎯 What I Learned

Handling dynamic nested arrays in post meta

Proper use of save_post

Debugging serialized data issues

WordPress media uploader event handling

Safe dynamic HTML rendering

Building maintainable modular code

📄 License

MIT — free to use and modify.