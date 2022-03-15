
<div class="border border-dark bg-dark text-white">
    <h5>&nbsp;<i class="fas fa-user"></i> &nbsp;  Hello, <?php echo $user?> </h5>
</div><br>
<div class="container">
<h1>My Questions...</h1><hr>
<div id="questions">

</div>
</div>

<script>
    fetch("lmquestions",{method:'GET',mode: 'no-cors',cache: 'no-cache'})
    .then(response => {
        if (response.status == 200) {return response.json();}
        else {console.log('Backend Error..!');console.log(response.text());}
    })
    .then(data => {
        if (data.length>0) {
            data.forEach(function(item){
                var htmltext=`
                    <div class="row">
                        <div class="col-10">
                            ${item["qtext"]}
                        </div>
                        <div class="col-1">
                            <a href="updatequestion/${item['qid']}" class="btn btn-info form-control">Edit</a>
                        </div>
                        <div class="col-1">
                            <a href="deletequestion/${item['qid']}" class="btn btn-warning form-control">Delete</a>
                        </div>   
                    </div>
                    <hr>
                `
                $("#questions").append(htmltext);
            });
        }
    })
    .catch(() => {console.log("Network connection error");});
</script>