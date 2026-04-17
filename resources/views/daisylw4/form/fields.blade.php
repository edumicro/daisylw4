@foreach($fields as $name => $field)
    @php
        $fieldType = $field['type'] ?? 'text';
        $fieldValue = $this->fieldValue($name, $field);
        $fieldModel = $this->fieldModel($name);
        $fieldError = $this->fieldErrorKey($name);
        $options = $this->getFieldOptions($field);
        $cols = $field['cols'] ?? 'col-span-12';
        $multiple = $this->isMultipleField($field);
    @endphp

    <div class="{{ $cols }} transition-all duration-200">
        @switch($fieldType)
            @case('textarea')
                <div class="form-control w-full">
                    @if(!empty($field['label']))
                        <label class="label"><span class="label-text font-medium">{{ $field['label'] }}</span></label>
                    @endif
                    <textarea
                        id="{{ $name }}"
                        @if($this->isActionForm())
                            name="{{ $name }}"
                        @else
                            wire:model.live="{{ $fieldModel }}"
                        @endif
                        placeholder="{{ $field['placeholder'] ?? '' }}"
                        class="textarea textarea-bordered w-full @error($fieldError) textarea-error @enderror"
                    >{{ $this->isActionForm() ? $fieldValue : '' }}</textarea>
                    @error($fieldError)
                        <label class="label p-0 mt-1"><span class="label-text-alt text-error font-semibold">{{ $message }}</span></label>
                    @enderror
                </div>
                @break

            @case('checkbox')
            @case('boolean')
            @case('toggle')
                <div class="form-control w-full">
                    @if($this->isActionForm())
                        <input type="hidden" name="{{ $name }}" value="0" />
                    @endif
                    <label class="label cursor-pointer justify-start gap-3">
                        <input
                            id="{{ $name }}"
                            type="checkbox"
                            @if($this->isActionForm())
                                name="{{ $name }}"
                                value="1"
                                @checked((bool) $fieldValue)
                            @else
                                wire:model.live="{{ $fieldModel }}"
                            @endif
                            class="checkbox checkbox-bordered @error($fieldError) checkbox-error @enderror"
                        />
                        <span class="label-text font-medium">{{ $field['label'] ?? ucfirst($name) }}</span>
                    </label>
                    @error($fieldError)
                        <label class="label p-0 mt-1"><span class="label-text-alt text-error font-semibold">{{ $message }}</span></label>
                    @enderror
                </div>
                @break

            @case('select')
            @case('multiselect')
            @case('tags')
            @case('relation')
            @case('relation_search')
                <div class="form-control w-full">
                    @if(!empty($field['label']))
                        <label class="label"><span class="label-text font-medium">{{ $field['label'] }}</span></label>
                    @endif
                    <select
                        id="{{ $name }}"
                        @if($this->isActionForm())
                            name="{{ $multiple ? $name . '[]' : $name }}"
                        @else
                            wire:model.live="{{ $fieldModel }}"
                        @endif
                        @if($multiple) multiple @endif
                        class="select select-bordered w-full @error($fieldError) select-error @enderror"
                    >
                        @if(!$multiple)
                            <option value="">{{ $field['placeholder'] ?? __('Select an option') }}</option>
                        @endif
                        @foreach($options as $optionValue => $optionLabel)
                            @if(is_array($optionLabel))
                                <optgroup label="{{ $optionValue }}">
                                    @foreach($optionLabel as $groupValue => $groupLabel)
                                        <option
                                            value="{{ $groupValue }}"
                                            @selected($multiple
                                                ? in_array((string) $groupValue, array_map('strval', (array) $fieldValue), true)
                                                : (string) $fieldValue === (string) $groupValue)
                                        >
                                            {{ $groupLabel }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @else
                                <option
                                    value="{{ $optionValue }}"
                                    @selected($multiple
                                        ? in_array((string) $optionValue, array_map('strval', (array) $fieldValue), true)
                                        : (string) $fieldValue === (string) $optionValue)
                                >
                                    {{ $optionLabel }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error($fieldError)
                        <label class="label p-0 mt-1"><span class="label-text-alt text-error font-semibold">{{ $message }}</span></label>
                    @enderror
                </div>
                @break

            @case('radio')
                <div class="form-control w-full gap-2">
                    @if(!empty($field['label']))
                        <label class="label"><span class="label-text font-medium">{{ $field['label'] }}</span></label>
                    @endif
                    @foreach($options as $optionValue => $optionLabel)
                        <label class="label cursor-pointer justify-start gap-3">
                            <input
                                type="radio"
                                value="{{ $optionValue }}"
                                @if($this->isActionForm())
                                    name="{{ $name }}"
                                    @checked((string) $fieldValue === (string) $optionValue)
                                @else
                                    wire:model.live="{{ $fieldModel }}"
                                @endif
                                class="radio radio-primary"
                            />
                            <span class="label-text">{{ $optionLabel }}</span>
                        </label>
                    @endforeach
                    @error($fieldError)
                        <label class="label p-0 mt-1"><span class="label-text-alt text-error font-semibold">{{ $message }}</span></label>
                    @enderror
                </div>
                @break

            @default
                <div class="form-control w-full">
                    @if(!empty($field['label']))
                        <label class="label"><span class="label-text font-medium">{{ $field['label'] }}</span></label>
                    @endif
                    <input
                        id="{{ $name }}"
                        type="{{ $this->fieldInputType($field) }}"
                        @if($this->isActionForm())
                            name="{{ $name }}"
                            value="{{ in_array($this->fieldInputType($field), ['password', 'file'], true) ? '' : (string) $fieldValue }}"
                        @else
                            wire:model{{ in_array($fieldType, ['text', 'email', 'password', 'number', 'money', 'percentage', 'date', 'datetime', 'color'], true) ? '' : '.live' }}="{{ $fieldModel }}"
                        @endif
                        placeholder="{{ $field['placeholder'] ?? '' }}"
                        class="input input-bordered w-full @error($fieldError) input-error @enderror"
                    />
                    @error($fieldError)
                        <label class="label p-0 mt-1"><span class="label-text-alt text-error font-semibold">{{ $message }}</span></label>
                    @enderror
                </div>
        @endswitch
    </div>
@endforeach