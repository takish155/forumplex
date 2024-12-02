<section class="w-[30%] flex justify-center max-h-[70vh] card-body py-10 max-w-[300px] shadow-xl bg-base-100 sticky top-[15vh]">
    <!-- Nothing worth having comes easy. - Theodore Roosevelt --> 
    <h3 class="text-md uppercase mb-4">{{ __("index.recentQuestions") }}</h3>
    @foreach($recentQuestions as $question)
        <x-mini-question-card :question="$question" />
    @endforeach
</section>