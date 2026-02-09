🚀 edumicro/daisylw4
**DaisyUI SFC components for Livewire 4 & Volt. Includes Auto-Form orchestrator, Smart Selects, and CLI scaffolding.**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/edumicro/daisylw4.svg?style=flat-square)](https://packagist.org/packages/edumicro/daisylw4)
[![Total Downloads](https://img.shields.io/packagist/dt/edumicro/daisylw4.svg?style=flat-square)](https://packagist.org/packages/edumicro/daisylw4)
[![License](https://img.shields.io/packagist/l/edumicro/daisylw4.svg?style=flat-square)](https://packagist.org/packages/edumicro/daisylw4)

**`daisylw4` is a productivity-first package for Laravel 12. It provides a set of Single File Components (SFC) styled with DaisyUI, powered by Livewire 4 and Volt, designed to eliminate boilerplate when building complex admin interfaces.**

🛠 Installation
1.- Install via Composer:
    composer require edumicro/daisylw4

2.- Run the Installer: This will publish all components to resources/views/vendor/daisylw4 so you have full control.
    php artisan daisylw4:install

3.- Tailwind Configuration: Ensure your tailwind.config.js tracks the published components:

content: [
    // ...
    './resources/views/vendor/daisylw4/**/*.blade.php',
],
plugins: [require("daisyui")],


🏗 Key Components
1. Auto-Form (form.auto-form)
    Generate complex, validated forms from a simple array. It supports automatic Eloquent relationships, field ordering, and multi-module injection.

    <livewire:daisylw4.form.auto-form 
        :model="App\Models\Product::class"
        :record="$product" {{-- Optional: For editing --}}
        :schema="[
            ['name' => 'name', 'label' => 'Product Name', 'order' => 10],
            ['name' => 'category_id', 'type' => 'relation', 'label' => 'Category', 'order' => 20],
            ['name' => 'price', 'type' => 'number', 'label' => 'Price', 'cols' => 'col-span-6', 'order' => 30],
        ]" 
    />

2. Data Table (display.table)
    Powerfull data grid with multi-term search and automatic pagination.

    <livewire:daisylw4.display.table 
        :model="App\Models\User::class" 
        :columns="[
            ['key' => 'name', 'label' => 'Full Name'],
            ['key' => 'email', 'label' => 'Email Address']
        ]" 
    />

🤖 Component Generator
Create your own standardized components that fit perfectly into the ecosystem.

    php artisan daisylw4:make {name}

Interactive: Choose the section (form, layout, display...).

Standardized: Automatically includes $model, $label, and $attributes->merge() logic.

Agnostic: Designed to work with the global translation system and zero naming collisions


📂 Architecture & Namespaces
To avoid conflicts with other DaisyUI packages, all components use the daisylw4 prefix:

Namespace: daisylw4::

Blade Usage: <livewire:daisylw4.{section}.{name} />

Customization: All files are located in resources/views/vendor/daisylw4.




## ❤️ Support Development

If `daisylw4` helps you build apps faster, consider supporting its maintenance. Your sponsorship helps keep the project updated with the latest Laravel and Livewire features.

[![GitHub Sponsors](https://img.shields.io/badge/Sponsor%20me-%23EA4AAA.svg?style=for-the-badge&logo=github-sponsors&logoColor=white)](https://github.com/sponsors/edumicro)




📄 License
The MIT License (MIT). Created by edumicro.
    