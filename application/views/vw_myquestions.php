<div class="container">
    <br>
    <h2>Question Topics</h2><hr width="100%">
    <div id="alertbox"></div>
    <div id="topics"></div>
</div>
<script>
    var message = "<?php echo $message; ?>";
    console.log("message : "+ message);
    if(message!=""){
        $("#alertbox").append(`<div class="alert alert-info">${message}</div>`);
    }
    $(".alert").delay(2000).slideUp(300, function() {
        $(this).alert('close');
    });

    fetch("<?php echo base_url('question/listmytopics');?>",{method:'GET',mode: 'no-cors',cache: 'no-cache'})
    .then(response => {
        if (response.status == 200) {return response.json();}
        else {console.log('Backend Error..!');console.log(response.text());}
    })
    .then(data => {
        if (data.length>0) {
            data.forEach(function(item){
                htmlText=`
                    <div class="row">
                        <div class="col-md-4"><h5>${item.topic}</h5></div>    
                        <div class="col-md-2">
                            <a href="<?php echo base_url('question/listquestionundertopic/')?>${item.topic}" class="btn btn-outline-primary form-control">View Questions</a> 
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo base_url('question/addquestion/${item.topic}') ?>" class="btn btn-outline-success form-control">Add Questions</a>
                        </div>    
                        <div class="col-md-2">
                            <button onclick="edittopic('${item.topic}')" class="btn btn-outline-warning form-control">Edit Topic</button>    
                        </div>    
                        <div class="col-md-2">
                            <button onclick="deltopic('${item.topic}')" class="btn btn-outline-danger form-control">Delete Topic</button> 
                        </div>
                    </div>
                    <hr width="100%">
                `;
                $("#topics").append(htmlText);
            }); 
        }else{
            htmlText=`<div class="alert alert-danger">No Topics Found</div>`;
                $("#topics").append(htmlText);
        }
    })
    .catch(() => {console.log("Network connection error");});

    function deltopic(topic){
        if(confirm("Are you sure you want to delete this topic.. Question and Answers under the topic also will be deleted.")){
            location.href=`<?php echo base_url('question/deletequestiontopic/${topic}') ?>`;
        }
    }
    function edittopic(topic){
        var newTopicName=prompt("Enter new topic name : ");
        if(newTopicName!=null){
            location.href=`<?php echo base_url('question/editquestiontopic/${topic}/${newTopicName}') ?>`;
        }
    }
</script>