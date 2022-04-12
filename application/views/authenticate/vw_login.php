<div class="container">
    <br><br>
    <!-- login Start -->
    <form id="loginForm" method="post">
        <div class="card border-dark ">
            <!-- card header -->
            <div class="card-header form-control-lg"><strong><center>Login</center></strong></div>
            <!-- card body -->
            <div class="card-body">
                <input value="m@mail.com" type="email" class="form-control-lg form-control rounded-3" required placeholder="Email" id="email">&nbsp;
                <input value="123" type="password" class="form-control-lg form-control rounded-3" required placeholder="Password" id="password">&nbsp;
                <hr>
                <div class="row"> <!--Button Set-->
                    <div class="col-6"><button type="submit" class="btn btn-outline-success btn-lg form-control">Login</button></div>
                    <div class="col-6"><button type="reset" class="btn btn-outline-danger btn-lg form-control">Clear</button></div>
                </div>
            </div> 
        </div><br>
        <a href="<?php echo base_url('authenticate/signup') ?>" class="btn btn-lg form-control btn-outline-primary">Signup</a>
    </form>
</div>
<script>
    $(document).on("submit","#loginForm",(e)=>{
        e.preventDefault();
        var toServer=new FormData();
        toServer.append('email',$("#email").val());
        toServer.append('password',$("#password").val());
        fetch("<?php echo base_url('authenticate/validatelogin') ?>",{
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
            if(data.result==true){
                location.href="<?php echo base_url('home') ?>";
            }
        })
        .catch((e) => {
            console.log(e);
            alert("Reloading"); //window.location.reload();
        });
        })
</script>