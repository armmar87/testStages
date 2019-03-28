$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    addAnswer();
    rightAnswer();
    nextQuestion();

});

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
    $('#nextQuestion').on('click', function () {
        let form = $(this).closest('form');
        let url = $(form).attr('action');
        let formData = form.serializeArray();
        let questionBlock = $(this).closest('div.stage-block');
        let secondBlock = questionBlock.find('#secondBlock');
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            success: function (response) {
                if (response.status == 'success') {
                    if(response.endStage)
                        location.href = '/end-stage';

                    questionBlock.hide();
                    questionBlock.next().show();
                    secondBlock.remove();
                    answerTime(response.second)
                }
            }
        });
    });
}

function answerTime(second) {
    function sec() {
        second--;
        $('#secondBlock').text(second + ' վրկ.');
        if(second == 0) {
            $('#nextQuestion').trigger('click');
        }

    }
    // if(second != 0) {
        setInterval(sec, 1000)
    // }



}
