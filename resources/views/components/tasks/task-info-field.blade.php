@props(['label', 'value', 'class' => ''])

<div class="{{ $class }}">
    <span class="font-medium text-gray-400">{{ $label }}:</span>
    <span class="text-gray-900 dark:text-white ml-2">{{ $value }}</span>
</div>