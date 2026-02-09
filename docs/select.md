# Select Component Guide

This guide explains how to use the Select component located at resources/views/daisylw4/form/select.blade.php.

## Overview

The Select component is a searchable, optionally multi-select dropdown with support for optgroups, clearable selections, and lazy (server-side) filtering for large datasets.

## Basic Usage (Single Select)

```blade
<livewire:daisylw4.form.select
    model="status"
    label="Status"
    :options="[
        'draft' => 'Draft',
        'published' => 'Published',
        'archived' => 'Archived',
    ]"
    placeholder="Select a status"
/>
```

## With Optgroups

```blade
<livewire:daisylw4.form.select
    model="country"
    label="Country"
    :options="[
        'Europe' => [
            'es' => 'Spain',
            'fr' => 'France',
        ],
        'Americas' => [
            'us' => 'United States',
            'mx' => 'Mexico',
        ],
    ]"
/>
```

## Multiple Selection

```blade
<livewire:daisylw4.form.select
    model="tags"
    label="Tags"
    :options="[
        'php' => 'PHP',
        'laravel' => 'Laravel',
        'livewire' => 'Livewire',
    ]"
    :multiple="true"
/>
```

Notes for multiple select:
- The component stores selected values as a comma-separated string in the bound `model` property.
- If you prefer an array, transform the value in your Livewire component (for example, explode on save and implode on mount).

## Search and Filtering

The search input filters the `options` list. To enable search, keep `searchable` as `true` (default).

```blade
<livewire:daisylw4.form.select
    model="user_id"
    label="User"
    :options="$users"
    :searchable="true"
/>
```

## Lazy (Server-Side) Search

For large datasets, set `lazy` to `true` and override the filtering logic inside the component (in the SFC) by updating `filterLazyOptions()`.

Example strategy:
- When `searchQuery` changes, fetch new results from your data source.
- Replace `filteredOptions` with the server results.

```php
// In the Select component class (SFC), customize:
protected function filterLazyOptions(string $query): void
{
    $this->filteredOptions = User::query()
        ->where('name', 'like', "%{$query}%")
        ->limit($this->maxResults)
        ->pluck('name', 'id')
        ->toArray();
}
```

## Props

### Required Standard Props
- `model` (string): Livewire model binding name.
- `label` (string): Field label.
- `id` (string): Optional ID for the container.
- `class` (string): Custom classes for the main button/input.
- `containerClass` (string): Custom classes for the wrapper.
- `extraAttributes` (array): Extra attributes applied to the root container.

### Select-Specific Props
- `options` (array): Options list (flat array or optgroup array).
- `placeholder` (string): Placeholder text when nothing is selected.
- `disabled` (bool): Disable interaction.
- `multiple` (bool): Enable multi-select mode.
- `searchable` (bool): Enable search input.
- `clearable` (bool): Show clear button when selection exists.
- `lazy` (bool): Enable lazy (server-side) filtering.
- `debounceMs` (int): Debounce time for search input.
- `size` (string): `xs`, `sm`, `md`, `lg`.
- `showCount` (bool): Show option count in the footer.
- `icon` (string): Right-side icon component name.
- `maxResults` (int): Limit for lazy results.
- `noResultsText` (string): Message shown when no matches.
- `loadingText` (string): Message shown during lazy search.

## Validation

The component shows validation errors automatically:

```blade
@error($model)
    <span class="text-error">{{ $message }}</span>
@enderror
```

## Accessibility Notes

- The trigger button uses a clear focus state and keyboard navigation.
- Use a clear `label` for accessibility.
- Ensure `options` labels are human-readable.

## Troubleshooting

- **Search does not update options**: Ensure `searchable` is true and that `filterOptions()` or `filterLazyOptions()` is being called.
- **Multiple selection values**: Values are stored as a comma-separated string. Convert to array in your Livewire component if needed.




