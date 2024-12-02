<!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->

@props(["answer"])

<section class="mb-8">
    <x-user-info-card :user="$answer->author" />
    <h3 class="text-sm"><a href="{{ route("answer.show", [
        "locale" => app()->getLocale(),
        "answer" => $answer
    ]) }}" class="hover:underline">{{ $answer->message }}</a></h3>
    <div class="flex gap-2">
</section>  