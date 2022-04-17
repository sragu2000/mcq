<div class="container">
    <br><br>
    <style>
        input[type="checkbox"] {
            text-align: center;
            vertical-align: middle;
        }
    </style>
    <div id="al"></div>
    <div class="row">
        <div class="col-md-6">
            <button onclick="addans()" class="btn btn-outline-success form-control">Add one answer</button>
        </div>
        <div class="col-md-6">
            <button onclick="deleteans()" class="btn btn-outline-warning form-control">Remove one answer</button>
        </div>
    </div>
    <p></p>
    <form id="ques">
        <input type="text" class="form-control" id="questionSetName" required placeholder="Enter name of the Question Set eg: Maths Exam 1">
        <!-- Question -->
        <!-- <div id="toolbar"></div>
        <div id="editor" style="height:100px"></div> -->
        <p></p>
        <textarea id="questext" placeholder="write your question" class="form-control rows=3" required></textarea>
        <p></p>
        <div id="answerArea">

        </div>
        <!-- Submit and Clear -->
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary form-control">Submit</button>&nbsp;
            </div>
            <div class="col-md-6">
                <button type="reset" class="btn btn-warning form-control">Clear</button>
            </div>
        </div>
    </form>

</div>
<script type="text/javascript">
    var topic="<?php echo $topic; ?>";
    console.log(topic);
    if(topic != ""){
        $("#questionSetName").val(topic);
        $("#questionSetName").prop('disabled', true); 
    }

    ansCount=1;
    function addans(){
        var htmlText=`
            <!-- Ans ${ansCount} -->
            <div class="row" id="set_${ansCount}">
                <div class="col-1">
                    <center><input type="checkbox" name="answers" id="chk_${ansCount}" class="answer form-check-input" /></center>
                </div>
                <div class="col-11">
                    <input type="text" class="form-control" id="ans_${ansCount}" placeholder="Type answer ${ansCount}" required /><br>
                </div>
            </div>
        `;
        $("#answerArea").append(htmlText);
        ansCount+=1;
    }
    function deleteans(){
        let chkText="#set_"+(ansCount-1);
        console.log(ansCount);
        if(ansCount>=2){
            ansCount-=1;
        }else{
            alert("No more answers to Delete");
        }
        
        $(chkText).remove();
    }
    // var toolbarOptions =[
    //     [{ header: [1, 2, false] }],
    //     ['bold', 'italic', 'underline','strike'],
    //     [ 'blockquote','code-block'],
    //     [{'list':'ordered'},{'list':'bullet'}],
    //     [{'script':'sub'},{'script':'super'}],
    //     ['link','formula','image','video'],
    //     [{'color':[]},{'background':[]}],
    //     [{'font':[]}],
    //     [{'align':[]}],
    // ];
    // var quill = new Quill('#editor', {
    //     modules: {
    //         toolbar: toolbarOptions
    //     },
    //     placeholder: 'Type Your Question Here...',
    //     theme: 'snow'
    // });

    $(document).on("submit", "#ques", (e) => {
        e.preventDefault();
        if(($("#answerArea").html()).trim()==""){
            alert("You cannot submit questions without answers");
            return false;
        }
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
        //console.log(JSON.stringify(answers));
        if(answers.length<=1){
            alert("Minimum answer count");
            return false;
        }

        var toServer = new FormData();
        //toServer.append('questionText', JSON.stringify(quill.getContents()));
        toServer.append('questionText',$("#questext").val());
        toServer.append('questionSetName',$("#questionSetName").val());
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
                if(data.result == true){
                    $("#al").append(`<div class='alert alert-success'>${data.message}</div>`);
                }else{
                    $("#al").append(`<div class='alert alert-danger'>${data.message}</div>`);
                }
                //reset form after alert
                var temp=$("#questionSetName").val();
                $("#ques").trigger('reset');
                $("#questionSetName").val(temp);
                //autoclose alert window
                $(".alert").delay(2000).slideUp(300, function() {
                    $(this).alert('close');
                });
            })
            .catch((err) => {
                console.log(err);
                alert("Reloading"); //window.location.reload();
            });
    })
    
</script>