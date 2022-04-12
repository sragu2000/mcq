<div class="container">
    <br><br>
    <style>
        input[type="checkbox"] {
            text-align: center;
            vertical-align: middle;
        }
    </style>
    <form id="ques">
        <!-- Question -->
        <textarea id="questext" placeholder="write your question" class="form-control rows=3" required></textarea>
        <p></p>
        <!-- Ans 1 -->
        <div class="row">
            <div class="col-1">
                <center><input type="checkbox" name="answers" id="chk_1" class="answer form-check-input" /></center>
            </div>
            <div class="col-11">
                <input type="text" class="form-control" id="ans_1" required /><br>
            </div>
        </div>
        <!-- Ans 2 -->
        <div class="row">
            <div class="col-1">
                <center><input type="checkbox" name="answers" id="chk_2" class="answer form-check-input" /></center>
            </div>
            <div class="col-11">
                <input type="text" class="form-control" id="ans_2" required /><br>
            </div>
        </div>
        <!-- Ans 3 -->
        <div class="row">
            <div class="col-1">
                <center><input type="checkbox" name="answers" id="chk_3" class="answer form-check-input" /></center>
            </div>
            <div class="col-11">
                <input type="text" class="form-control" id="ans_3" required /><br>
            </div>
        </div>
        <!-- Ans 4 -->
        <div class="row">
            <div class="col-1">
                <center><input type="checkbox" name="answers" id="chk_4" class="answer form-check-input" /></center>
            </div>
            <div class="col-11">
                <input type="text" class="form-control" id="ans_4" required /><br>
            </div>
        </div>
        <!-- Ans 5 -->
        <div class="row">
            <div class="col-1">
                <center><input type="checkbox" name="answers" id="chk_5" class="answer form-check-input" /></center>
            </div>
            <div class="col-11">
                <input type="text" class="form-control" id="ans_5" required /><br>
            </div>
        </div>
        <!-- Submit and Clear -->
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-lg btn-outline-primary form-control">Submit</button>&nbsp;
            </div>
            <div class="col-md-6">
                <button type="reset" class="btn btn-lg btn-outline-warning form-control">Clear</button>
            </div>
        </div>
    </form>

</div>
<script type="text/javascript">
    $(document).on("submit", "#ques", (e) => {
        e.preventDefault();
        var answers = [];
        $(".answer").each(function() {
            var thisId = $(this).attr("id");
            //thisId = "chk_1" 
            //seperate the number 1 or 2 or 3 or 4 or 5
            var chkBoxNum = thisId.substring(thisId.indexOf("_") + 1, thisId.length);
            var answerText = $("#ans_" + chkBoxNum).val();
            if ($(this).is(":checked")) {
                answers.push({
                    "answerText": answerText,
                    "state": true
                });
            } else {
                answers.push({
                    "answerText": answerText,
                    "state": false
                });
            }
        });
        console.log(answers);
        console.log(JSON.stringify(answers));


        var toServer = new FormData();
        toServer.append('questionText', $("#questext").val());
        toServer.append('encodedAnswers', JSON.stringify(answers));
        fetch("<?php echo base_url('question/insertquestion'); ?>", {
                method: 'POST',
                body: toServer,
                mode: 'no-cors',
                cache: 'no-cache'
            })
            .then(response => {
                if (response.status == 200) {
                    return response.json();
                } else {
                    alert('Backend Error..!');
                    console.log(response.text());
                }
            })
            .then(data => {
                alert(data.message); //window.location.reload();
            })
            .catch((err) => {
                console.log(err);
                alert("Reloading"); //window.location.reload();
            });
    })
</script>