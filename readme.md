🚀 edumicro/daisylw4
 Daisy UI styled LiveWire 4 SFC Components with creators command and Autoforms


[![Latest Version on Packagist](https://img.shields.io/packagist/v/edumicro/daisylw4.svg?style=flat-square)](https://packagist.org/packages/edumicro/daisylw4)
[![Total Downloads](https://img.shields.io/packagist/dt/edumicro/daisylw4.svg?style=flat-square)](https://packagist.org/packages/edumicro/daisylw4)
[![License](https://img.shields.io/packagist/l/edumicro/daisylw4.svg?style=flat-square)](https://packagist.org/packages/edumicro/daisylw4)

**The ultimate "View Painter" for Laravel 12 & Livewire 4.**

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




📄 License
The MIT License (MIT). Created by edumicro.
    