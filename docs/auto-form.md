# Auto Form Component Guide

This guide explains how to use the Auto Form component located at resources/views/daisylw4/form/auto-form.blade.php.

## Overview

The Auto Form component is a schema-driven form container. It renders form fields dynamically based on a schema array and emits a `form-submitted` event with the collected data.

## Basic Usage

```blade
<livewire:daisylw4.form.auto-form
    :schema="[
        [
            'name' => 'username',
            'type' => 'text',
            'label' => 'Username',
            'placeholder' => 'Enter your username',
            'rules' => 'required|min:3',
            'icon' => 'heroicon-o-user',
            'iconSide' => 'left',
        ],
        [
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email',
            'placeholder' => 'you@example.com',
            'rules' => 'required|email',
            'icon' => 'heroicon-o-envelope',
            'iconSide' => 'left',
        ],
    ]"
    modelPrefix="form"
    submitLabel="Create Account"
/>
```

## Schema Structure

Each field supports the following keys:

- `name` (string, required): Field name.
- `type` (string): Field type (text, email, password, number, textarea, select, checkbox, toggle, radio, date, time, tel, url).
- `label` (string): Field label.
- `placeholder` (string): Input placeholder.
- `options` (array): For select and radio.
- `class` (string): Custom classes for the field.
- `disabled` (bool): Disable the field.
- `icon` (string): Icon component name.
- `iconSide` (string): `left` or `right`.
- `rules` (string): Validation rules (handled in parent component).

## Model Prefix

`modelPrefix` lets you bind all fields under a common object.

Example:

```blade
<livewire:daisylw4.form.auto-form
    :schema="[
        ['name' => 'first_name', 'type' => 'text', 'label' => 'First Name'],
        ['name' => 'last_name', 'type' => 'text', 'label' => 'Last Name'],
    ]"
    modelPrefix="form"
/>
```

This will bind to `form.first_name` and `form.last_name`.

## Examples

### Example 1: Registration Form

```blade
<livewire:daisylw4.form.auto-form
    :schema="[
        ['name' => 'name', 'type' => 'text', 'label' => 'Name', 'placeholder' => 'John Doe'],
        ['name' => 'email', 'type' => 'email', 'label' => 'Email', 'placeholder' => 'john@example.com'],
        ['name' => 'password', 'type' => 'password', 'label' => 'Password'],
        ['name' => 'role', 'type' => 'select', 'label' => 'Role', 'options' => [
            'admin' => 'Admin',
            'editor' => 'Editor',
        ]],
        ['name' => 'terms', 'type' => 'checkbox', 'label' => 'Accept Terms'],
    ]"
    modelPrefix="form"
    submitLabel="Register"
    submitVariant="btn-primary"
/>
```

### Example 2: Preferences Form

```blade
<livewire:daisylw4.form.auto-form
    :schema="[
        ['name' => 'language', 'type' => 'select', 'label' => 'Language', 'options' => [
            'en' => 'English',
            'es' => 'Spanish',
        ]],
        ['name' => 'notifications', 'type' => 'toggle', 'label' => 'Email Notifications'],
        ['name' => 'theme', 'type' => 'radio', 'label' => 'Theme', 'options' => [
            'light' => 'Light',
            'dark' => 'Dark',
        ]],
    ]"
    modelPrefix="settings"
    submitLabel="Save Preferences"
    submitVariant="btn-secondary"
/>
```

### Example 3: Inline Fields with Icons

```blade
<livewire:daisylw4.form.auto-form
    :schema="[
        [
            'name' => 'phone',
            'type' => 'tel',
            'label' => 'Phone',
            'placeholder' => '+1 555 123 4567',
            'icon' => 'heroicon-o-phone',
            'iconSide' => 'left',
        ],
        [
            'name' => 'website',
            'type' => 'url',
            'label' => 'Website',
            'placeholder' => 'https://example.com',
            'icon' => 'heroicon-o-link',
            'iconSide' => 'left',
        ],
    ]"
    modelPrefix="contact"
    submitLabel="Update"
    submitVariant="btn-accent"
/>
```

## Submit Handling

The component dispatches a `form-submitted` event with the form data. Handle it in the parent Livewire component:

```php
protected $listeners = ['form-submitted' => 'handleSubmit'];

public function handleSubmit(array $formData): void
{
    // Validate and save
}
```

## Supported Field Types

- text
- email
- password
- number
- tel
- url
- date
- time
- textarea
- select
- checkbox
- toggle
- radio

## Notes

- Validation is handled in the parent component.
- You can extend `componentMap` to support custom field types.
- Use `class` for per-field styling and `containerClass` for layout styling.



