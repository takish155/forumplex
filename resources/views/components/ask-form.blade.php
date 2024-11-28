<form enctype="multipart/form-data" method="POST" action="{{ route('question.store', app()->getLocale()) }}">
    <!-- Be present above all else. - Naval Ravikant -->
    @csrf

    <x-input-container :required="true" for="title" label="{{ __('question.questionTitle') }}">
        <input value="{{ old('title') }}" min="3" max="50" required placeholder="{{ __('question.titleHint') }}" name="title" id="title" class="input w-full input-bordered input-sm" />
    </x-input-container>
    <x-input-container :required="true" for="description" label="{{ __('question.questionDescription') }}">
        <textarea min="3" max="1000" required placeholder="{{ __('question.descriptionHint') }}" name="description" id="description" class="input h-48 w-full input-bordered">{{ old('description') }}</textarea>
    </x-input-container>
    <x-input-container for="image" label="{{ __('question.questionImage') }}">
        <input type="file" name="image" class="file-input w-full max-w-xs" />    
    </x-input-container>

    <div class="flex justify-end">
        <button class="btn btn-primary btn-sm">{{ __('question.submit') }}</button>
    </div>
</form>