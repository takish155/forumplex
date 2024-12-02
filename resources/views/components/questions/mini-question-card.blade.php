@props(["question"])

<!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
<section class="mb-8">
    <x-user-info-card :user="$question->author" />
    <h3 class="text-sm"><a href="{{ route("question.show", [
        "locale" => app()->getLocale(),
        "question" => $question
    ]) }}" class="hover:underline">{{ $question->question_title }}</a></h3>
    <div class="flex gap-2">
</section>  