$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    addAnswer();
    rightAnswer();
    nextQuestion();
    saveStage();
    answerTime();

});

let interval;

function addAnswer() {
    $('#addAnswer').on('click', function () {
        let answerBlock = $('#answerBlock');
        let inputsLength = answerBlock.find('input[type="checkbox"]').length;
        let newInput = '<div class="input-group mb-2">' +
            '<input name="rightAnswer" value="' + inputsLength + '"  type="checkbox" class="m-3" style="height: 25px;width: 25px">'+
            '<textarea class="form-control" name="answers[]" rows="2"></textarea></div>';
        answerBlock.append(newInput);
    })
}

function rightAnswer() {
    $(document).on('click', 'input[type="checkbox"]', function () {
        let answerBlock = $(this).closest('div#answerBlock');
        let inputs = answerBlock.find('input[type="checkbox"]');
        inputs.each(function (key, input) {
            $(input).prop('checked', false)
        });
        $(this).prop('checked', true)
    })
}

function nextQuestion() {
    $(document).on('click','.next-question', function () {
        let form = $(this).closest('form');
        let url = $(form).attr('action');
        let formData = form.serializeArray();
        let questionBlock = $('#questionBlock');

        // let questionBlock = $(this).closest('div.stage-block');
        // let secondBlock = questionBlock.find('#secondBlock');
        let second = questionBlock.next().find('.answer-time').val();

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response.status == 'success') {
                    if(response.endStage)
                        location.href = '/end-stage';

                    questionBlock.html(response.content);
                    window.clearInterval(interval);
                    answerTime(second)
                }
            }
        });
    });
}

function saveStage() {
    $('#saveStage').on('click', function () {
        let form = $(this).closest('form');
        let url = $(this).data('url');
        let formData = form.serializeArray();
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response.status == 'success') {
                    location.href = '/';
                }
            }
        });
    });
}

function answerTime( second ) {
    second = second ? second : $('#secondBlock').text();
    interval = window.setInterval( function() {
            second--;
            if( second > 0 ) {
                $('#secondBlock').text(second + ' վրկ.');
            } else {
                $('#nextQuestion').trigger('click');
            }
            return false;
        }, 1000 );
}

