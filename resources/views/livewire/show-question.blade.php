<div>
    <div>
        <div class="card card-statistics mb-30">
            <div class="card-body">
                @if(isset($data[$counter]))
                    <h5 class="card-title">{{ $data[$counter]->title }}</h5>

                    @foreach(preg_split('/(-)/', $data[$counter]->answers) as $index => $answer)
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio{{$index}}" name="customRadio" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio{{$index}}" wire:click="nextQuestion({{ $data[$counter]->id }}, {{ $data[$counter]->score }}, '{{ $answer }}', '{{ $data[$counter]->right_answer }}')"> 
                                {{ $answer }}
                            </label>
                        </div>
                    @endforeach
                @else
                    <h5 class="card-title text-danger">لم يتم العثور على السؤال</h5>
                @endif
            </div>
        </div>
    </div>
</div>
