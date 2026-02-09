<?php

use Livewire\Component;
use Livewire\Volt\Component as VoltComponent;

new class extends VoltComponent {
    /**
     * Mandatory standard props
     */
    public string $model = '';
    public string $label = '';
    public string $id = '';
    public string $class = '';
    public string $containerClass = '';
    public array $extraAttributes = [];

    /**
     * Validator specific props
     */
    public array $rules = [];
    public array $messages = [];
    public array $errors = [];
    public string $value = '';
    public bool $showRules = true;
    public bool $validated = false;
    public string $type = 'inline';
    public array $validationRules = [];

    /**
     * Rule patterns for display
     */
    protected array $rulePatterns = [
        'required' => ['icon' => 'heroicon-o-exclamation-circle', 'label' => 'Required field'],
        'email' => ['icon' => 'heroicon-o-envelope', 'label' => 'Valid email format'],
        'url' => ['icon' => 'heroicon-o-link', 'label' => 'Valid URL'],
        'min' => ['icon' => 'heroicon-o-arrow-small-up', 'label' => 'Minimum length'],
        'max' => ['icon' => 'heroicon-o-arrow-small-down', 'label' => 'Maximum length'],
        'numeric' => ['icon' => 'heroicon-o-hashtag', 'label' => 'Must be numeric'],
        'confirmed' => ['icon' => 'heroicon-o-check-circle', 'label' => 'Must be confirmed'],
        'same' => ['icon' => 'heroicon-o-check-circle', 'label' => 'Must match'],
        'different' => ['icon' => 'heroicon-o-x-circle', 'label' => 'Must be different'],
        'regex' => ['icon' => 'heroicon-o-list-bullet', 'label' => 'Invalid format'],
        'date' => ['icon' => 'heroicon-o-calendar', 'label' => 'Valid date format'],
        'after' => ['icon' => 'heroicon-o-calendar', 'label' => 'Must be after date'],
        'before' => ['icon' => 'heroicon-o-calendar', 'label' => 'Must be before date'],
    ];

    /**
     * Validate the value
     */
    public function validate(): bool
    {
        $this->errors = [];
        $this->validated = true;

        foreach ($this->validationRules as $rule) {
            $result = $this->checkRule($rule);
            if (!$result['valid']) {
                $this->errors[] = [
                    'rule' => $rule,
                    'message' => $result['message'] ?? $this->messages[$rule] ?? $result['message'],
                ];
            }
        }

        return empty($this->errors);
    }

    /**
     * Check individual rule
     */
    protected function checkRule(string $rule): array
    {
        // Simple rule checking
        if ($rule === 'required' && empty($this->value)) {
            return ['valid' => false, 'message' => 'This field is required'];
        }

        if ($rule === 'email' && !filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            return ['valid' => false, 'message' => 'Invalid email format'];
        }

        if ($rule === 'url' && !filter_var($this->value, FILTER_VALIDATE_URL)) {
            return ['valid' => false, 'message' => 'Invalid URL format'];
        }

        if (strpos($rule, 'min:') === 0) {
            $min = (int) substr($rule, 4);
            if (strlen($this->value) < $min) {
                return ['valid' => false, 'message' => "Minimum {$min} characters required"];
            }
        }

        if (strpos($rule, 'max:') === 0) {
            $max = (int) substr($rule, 4);
            if (strlen($this->value) > $max) {
                return ['valid' => false, 'message' => "Maximum {$max} characters allowed"];
            }
        }

        if ($rule === 'numeric' && !is_numeric($this->value)) {
            return ['valid' => false, 'message' => 'Must be numeric'];
        }

        return ['valid' => true];
    }

    /**
     * Get rule display info
     */
    public function getRuleInfo(string $rule): array
    {
        $baseRule = explode(':', $rule)[0];
        $info = $this->rulePatterns[$baseRule] ?? ['icon' => 'heroicon-o-check', 'label' => $rule];
        
        // Add parameter if it exists
        if (strpos($rule, ':') !== false) {
            $param = explode(':', $rule)[1];
            $info['label'] .= " ({$param})";
        }

        return $info;
    }

    /**
     * Get rule validation status
     */
    public function isRuleValid(string $rule): bool
    {
        return !in_array($rule, array_map(fn($e) => $e['rule'], $this->errors));
    }
}; ?>

<div class="{{ $containerClass }}" {{ $attributes->merge($extraAttributes) }}>
    @if ($label)
        <div class="mb-4 pb-3 border-b border-base-300">
            <h3 class="font-semibold">{{ $label }}</h3>
        </div>
    @endif

    @if ($type === 'inline' || $type === 'full')
        <div class="space-y-3">
            @if (!empty($validationRules) && $showRules)
                <div class="bg-base-200/30 rounded-lg p-4">
                    <p class="text-sm font-medium mb-3 text-base-content/80">Validation Rules:</p>
                    <div class="space-y-2">
                        @foreach ($validationRules as $rule)
                            @php
                                $ruleInfo = $this->getRuleInfo($rule);
                                $isValid = $this->isRuleValid($rule);
                            @endphp
                            <div class="flex items-center gap-2 text-sm {{ $isValid ? 'text-success' : 'text-error' }}">
                                @if ($isValid)
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                                <span>{{ $ruleInfo['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (!empty($errors) && $validated)
                <div class="alert alert-error">
                    <div class="flex flex-col gap-2">
                        <h4 class="font-semibold">Validation Errors:</h4>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors as $error)
                                <li class="text-sm">{{ $error['message'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @elseif ($validated && empty($errors))
                <div class="alert alert-success">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span>All validations passed!</span>
                    </div>
                </div>
            @endif
        </div>
    @elseif ($type === 'badge')
        <div class="flex flex-wrap gap-2">
            @foreach ($validationRules as $rule)
                @php
                    $isValid = $this->isRuleValid($rule);
                    $ruleInfo = $this->getRuleInfo($rule);
                @endphp
                <span class="badge {{ $isValid ? 'badge-success' : 'badge-error' }} gap-1">
                    @if ($isValid)
                        ✓
                    @else
                        ✕
                    @endif
                    {{ $ruleInfo['label'] }}
                </span>
            @endforeach
        </div>
    @elseif ($type === 'progress')
        @php
            $totalRules = count($validationRules);
            $validRules = $totalRules - count($errors);
            $percentage = $totalRules > 0 ? ($validRules / $totalRules) * 100 : 0;
        @endphp
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <span class="text-sm font-medium">Validation Progress</span>
                <span class="text-sm font-semibold">{{ $validRules }}/{{ $totalRules }}</span>
            </div>
            <progress class="progress {{ $percentage === 100 ? 'progress-success' : ($percentage >= 50 ? 'progress-warning' : 'progress-error') }} w-full" value="{{ $percentage }}" max="100"></progress>
        </div>
    @endif

    @if ($model)
        @error($model)
            <span class="text-error text-xs block mt-4">{{ $message }}</span>
        @enderror
    @endif
</div>
