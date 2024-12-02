@props(['answer', "question", "needMargin" => true])

@php
$locale = app()->getLocale();

$params = [
    "locale" => $locale,
    "answer" => $answer,
];
@endphp

<section class="w-full card card-body bg-base-100 shadow-lg {{ $needMargin ? 'mb-10' : ''}}">
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
    <x-user-info-card :user="$answer->author" />
    <p>{{ $answer->message }}</p>
    @if($answer->answer_image_path)
                <div class="w-full h-auto mb-2">
                    <img src="{{ asset($answer->answer_image_path) }}" alt="answer Image" class="w-full h-auto object-cover rounded-lg" />
                </div>
    @endif
    <div class="flex justify-end gap-2">
        @can("delete", $answer)
            <form method="POST" action="{{ route('answer.destroy', $params) }}">
                @csrf
                @method("DELETE")
                <button class="btn btn-error btn-xs"><i class="fa-solid fa-trash"></i> {{ __("index.delete") }} </button>
            </form>
        @endcan
        <div class="flex gap-1 justify-center items-center badge badge-lg bg-base-200">
            <form method="POST" action="{{ route('answer-vote.store', $params) }}">
                @csrf
                <input 
                    type="hidden" 
                    name="is_helpful" 
                    value="1"
                />
                <button class="btn btn-xs @if($answer->upvoted()) btn-outline  @else btn-ghost @endif"><i class="fa-solid fa-arrow-up"></i></button>
            </form>
            <span class="text-xs">{{ $answer->voteCount() }}</span>
            <form method="POST" action="{{ route('answer-vote.store', $params) }}">
                @csrf
                <input 
                    type="hidden" 
                    name="is_helpful" 
                    value="0"
                />
                <button class="btn btn-xs @if($answer->downvoted()) btn-outline  @else btn-ghost @endif"><i class="fa-solid fa-arrow-down"></i></button>
            </form>
        </div>
    </div>
</section>