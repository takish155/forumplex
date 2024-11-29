@props(["question", "isMain" => false])

@php
    $locale = app()->getLocale();

    $params = [
        "locale" => $locale,
        "question" => $question,
    ];
@endphp


<!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
<div class="card-actions">
    <div class="flex gap-1 justify-center items-center badge badge-lg bg-base-200">
        <form method="POST" action="{{ route('question-vote.store', $params) }}">
            @csrf
            <input 
                type="hidden" 
                name="is_helpful" 
                value="1"
            />
            <button class="btn btn-xs @if($question->upvoted()) bg-gray-300  @else btn-ghost @endif"><i class="fa-solid fa-arrow-up"></i></button>
        </form>
        <span class="text-xs">{{ $question->voteCount() }}</span>
        <form method="POST" action="{{ route('question-vote.store', $params) }}">
            @csrf
            <input 
                type="hidden" 
                name="is_helpful" 
                value="0"
            />
            <button class="btn btn-xs @if($question->downvoted()) bg-gray-300  @else btn-ghost @endif"><i class="fa-solid fa-arrow-down"></i></button>
        </form>
    </div>
    <button class="btn btn-base-300 btn-xs"><i class="fa-solid fa-message"></i>{{ $question->answers()->count()  }}</button>
    <button class="btn btn-base-300 btn-xs"><i class="fa-solid fa-share"></i> {{ __("index.share") }}</button>
    @if($isMain)
        @can("delete", $question)
            <a href="{{ route('question.edit', $params) }}">
                 <button class="btn bg-base-200 btn-xs"><i class="fa-solid fa-pen"></i> {{ __("index.edit") }}</button>
            </a>
            <form method="POST" action="{{ route('question.markAsSolved', $params) }}">
                @csrf
                <button class="btn @if($question->is_solved) btn-outline @else text-white btn-success @endif btn-xs">
                    @if($question->is_solved)
                        <i class="fa-solid fa-question"></i> {{ __("question.unmarkSolve") }}
                    @else
                        <i class="fa-solid fa-check"></i> {{ __("question.markAsSolved") }}
                    @endif
                </button>
            </form>
            <form method="POST" action="{{ route('question.destroy', $params) }}">
                @csrf
                @method("DELETE")
                <button class="btn btn-error btn-xs"><i class="fa-solid fa-trash"></i> {{  __("index.delete") }}</button>
            </form>
        @endcan
    @endif
</div>