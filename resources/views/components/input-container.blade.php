@props(["label", "for", "errorMessage", "required" => false])

<div class="mb-3 mx-auto">
    <!-- He who is contented is rich. - Laozi -->
    <label class="block" for="{{ $for }}" class="">{{ $label }}@if($required)<span class="text-red-500 ml-1">*</span>@endif</label>
    {{ $slot }}
    @error($for)
        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p> 
    @enderror
</div>