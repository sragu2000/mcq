<div class="border border-dark bg-dark text-white">
    <h5>&nbsp;<i class="fas fa-user"></i> &nbsp;  Hello, <?php echo $user?> </h5>
</div><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-8  border border-dark">Answer Count : </div>
            <div class="col-md-2"> <input type="number" class="form-control " value="4" id="numofans" min="1" max="5"></div>
            <div class="col-md-2"><button class="btn  btn-success form-control" id="add">ADD</button></div>
        </div>
        <br>
        <!-- ------------------------------- -->
        <form id="questionset">
            <hr width="100%">
            <!-- Question -->
            <div class="row">
                <div class="col-12">
                    <textarea class="question form-control" placeholder="Question" id="question" required></textarea>
                </div>
            </div>
            <!-- Answer -->
            <div id="ans"></div>
            <!-- Answer End -->
            <hr width="100%">
            <input type="submit" class="btn btn-success form-control" value="Add Question"> &nbsp;
            <input type="reset" class="btn  btn-danger form-control" value="Clear">
        </form>
        <!-- ------------------------------- -->
    </div>
    <script>
        $(document).on("click","#add",()=>{
            var ques=$("#numofans").val();
            document.getElementById("ans").innerHTML="";
            for(var i=1;i<=ques;i++){
                $("#ans").append(`
                ${i} <input type="radio" name="answer" class="corans" value="${i}" required>
                <input type="text" class="form-control possibleanswer" required>`
                );
            }
        })

        $(document).on("submit","#questionset",(e)=>{
            // if($("#ans").val()!=''){
                e.preventDefault();
                    var toServer=new FormData();
                    toServer.append('question',$("#question").val());
                    toServer.append('correctanswer',$('input[type="radio"].corans:checked').val());
                    var arr={};
                    var count=0;
                    $('input[type="text"].possibleanswer').each(function () {
                        arr[count]=$(this).val();
                        count++;
                    });
                    var cv=JSON.stringify(arr);
                    toServer.append('answers',cv);
                    
                    fetch("<?php echo base_url('home/addq'); ?>",{
                        method:'POST',
                        body: toServer,
                        mode: 'no-cors',
                        cache: 'no-cache'})
                    .then(response => {
                        if (response.status == 200) {
                            return response.json();            
                        }
                        else {
                            alert('Backend Error..!');
                            console.log(response.text());
                        }
                    })
                    .then(data => {
                        alert(data.message);
                        window.location.reload();
                    })
                    .catch((e) => {
                        console.log(e);
                    });
            // }else{
            //     alert("Add Answers")
            // }
        })
    </script>