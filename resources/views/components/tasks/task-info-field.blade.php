@props(['label', 'value', 'class' => '', 'block' => false])

<div class="{{ $class }} @if (!$block) flex items-center @endif">
    <span class="text-gray-400 font-medium">{{ $label }}:</span>

    @if($block)
        <div class="mt-1 ml-2 text-gray-900 dark:text-white whitespace-pre-line">{{ $value }}</div>
    @else
        <div class="ml-2 text-gray-900 dark:text-white">{{ $value }}</div>
    @endif
</div>
