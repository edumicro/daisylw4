⚡ Quick Start: Your first Auto-Form
Want to create a full "Contact Us" form with validation and a clean layout? Just pass this array to the auto-form:

    // Inside your Livewire Component
    $schema = [
        [
            'name'  => 'full_name', 
            'label' => 'Full Name', 
            'icon'  => 'heroicon-o-user', 
            'cols'  => 'col-span-12'
        ],
        [
            'name'  => 'email', 
            'type'  => 'email', 
            'label' => 'Email Address', 
            'cols'  => 'col-span-6'
        ],
        [
            'name'  => 'department', 
            'type'  => 'select', 
            'label' => 'Department', 
            'cols'  => 'col-span-6',
            'options' => ['sales' => 'Sales', 'tech' => 'Support']
        ],
        [
            'name'  => 'message', 
            'type'  => 'textarea', 
            'label' => 'Your Message'
        ],
    ];

    //And in your Blade:
    <livewire:daisylw4.form.auto-form 
        :schema="$schema" 
        submit-label="Send Message"
        class="p-6 bg-base-100 shadow-xl rounded-2xl"
    />

🧩 Advantages:
Grid by default: Everything uses a 12-column grid. You control the width with cols.

Auto-Validation: It reads your model's rules or uses the ones you define in the schema.

Extendable: Need to add a field from another module? Just inject a new item into the $schema array with an order value.