<div class="border border-dark bg-dark text-white">
    <h5>&nbsp;<i class="fas fa-user"></i> &nbsp;  Hello, <?php echo $user?> </h5>
</div>
<div class="container">
    <br>
    <h1> Questions</h1><hr>
    <div id="qlist">

    </div>
</div>
<script>
    fetch("<?php echo base_url('home/getAllQuestions'); ?>",{method:'GET',mode: 'no-cors',cache: 'no-cache'})
    .then(response => {
        if (response.status == 200) {return response.json();}
        else {console.log('Backend Error..!');console.log(response.text());}
    })
    .then(data => {
        if (data.length>0) {
            data.forEach(function(item){
                console.log(item);
                $("#qlist").append(`<b> ${item["qtext"]} </b><hr><p></p>`)
            });
        }
    })
    .catch(() => {console.log("Network connection error");});

</script>