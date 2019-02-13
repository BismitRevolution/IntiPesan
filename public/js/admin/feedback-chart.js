$(document).ready(function() {
    console.log('chart loaded');

    function draw(id, series) {
        var labels = ['Sangat Buruk', 'Buruk', 'Sedang', 'Baik', 'Sangat Baik'];
        new Chartist.Pie('#' + id, {
            series: series,
        }, {
            height: 250,
            // donut: true,
            // donutWidth: 50,
            donutSolid: true,
            labelInterpolationFnc: function (value, idx) {
                return (value == 0)? "" : labels[idx] + " (" + value + ")";
            },
            // distributeSeries: true,
        });
    }

    // GENERATE QUESTIONS
    var t_questions = [];
    for (var i = 0; i < q_sessions.length; i++) {
        if (q_sessions[i]['answer_type'] == 3) {
            t_questions[i] = [q_sessions[i]['question'], q_sessions[i]['colname']];
        }
    }
    var s_questions = [];
    for (var i = 0; i < q_speakers.length; i++) {
        if (q_speakers[i]['answer_type'] == 3) {
            s_questions[i] = [q_speakers[i]['question'], q_speakers[i]['colname']];
        }
    }

    // SESSION
    for (var i = 0; i < tracks.length; i++) {
        var answers = [];
        for (var j = 0; j < t_questions.length; j++) {
            answers[j] = [0, 0, 0, 0, 0];
        }
        var feedbacks = tracks[i]['feedbacks'];
        for (var j = 0; j < feedbacks.length; j++) {
            for (var k = 0; k < t_questions.length; k++) {
                answers[k][feedbacks[j][t_questions[k][1]]-1]++;
            }
        }
        for (var j = 0; j < t_questions.length; j++) {
            var id = 'title-t-' + tracks[i]['track_id'] + '-s-' + t_questions[j][1];
            document.getElementById(id).innerText = t_questions[j][0];
            draw(id, answers[j]);
        }

        // SPEAKER
        for (var j = 0; j < tracks[i]['speakers'].length; j++) {
            var s_answers = [];
            for (var k = 0; k < s_questions.length; k++) {
                s_answers[k] = [0, 0, 0, 0, 0];
            }
            var s_feedbacks = tracks[i]['speakers'][j]['feedbacks'];
            for (var k = 0; k < s_feedbacks.length; k++) {
                for (var l = 0; l < s_questions.length; l++) {
                    s_answers[l][s_feedbacks[k][s_questions[l][1]]-1]++;
                }
            }
            for (var k = 0; k < s_questions.length; k++) {
                var s_id = 't-' + tracks[i]['track_id'] + '-sp-' + tracks[i]['speakers'][j]['speaker_id'] + '-q-' + s_questions[k][1];
                console.log(s_id);
                document.getElementById('title-' + s_id).innerText = s_questions[k][0];
                draw(s_id, s_answers[k]);
                console.log(s_answers[k]);
            }

        }
    }

    // ==================================
    $sessions = tracks[0]['feedbacks'];
    for ($i = 0; $i < $sessions.length; $i++) {
        // console.log($sessions[$i]);
    }
    $speakers = tracks[1];
});
