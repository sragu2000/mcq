<br><br>
<div class="container">
<div class="row">
<div class="col-sm-6">
    <!-- login Start -->
    <form id="login">
    <div class="card border-dark ">
        <!-- card header -->
        <div class="card-header form-control-lg"><strong><center>Login</center></strong></div>
        <!-- card body -->
        <div class="card-body">
        <input type="email" class="form-control-lg form-control rounded-3" required placeholder="Email" id="email">&nbsp;
        <input type="password" class="form-control-lg form-control rounded-3" required placeholder="Password" id="password">&nbsp;
        <hr>
        <div class="row"> <!--Button Set-->
            <div class="col-6"><button type="submit" class="btn btn-outline-success btn-lg form-control">Login</button></div>
            <div class="col-6"><button type="reset" class="btn btn-outline-danger btn-lg form-control">Clear</button></div>
        </div>
        </div>  
    </div>
    </form>
    <!-- Login End -->
</div>
<!-------------------------------------------------------->
<div class="col-sm-6">
    <!-- signup start -->
    <form id="signup">
    <div class="card border-dark ">
        <!-- card header -->
        <div class="card-header form-control-lg"><strong><center>SignUp</center></strong></div>
        <!-- card body -->
        <div class="card-body">
        <input type="text" class="form-control-lg form-control rounded-3" required placeholder="First Name" id="spfname"> &nbsp;
        <input type="text" class="form-control-lg form-control rounded-3" required placeholder="Last Name" id="splname"> &nbsp;
        <input type="email" class="form-control-lg form-control rounded-3" required placeholder="Email" id="spemail">&nbsp;
        <input type="password" class="form-control-lg form-control rounded-3" required placeholder="Password" id="sppassword">&nbsp;
        <input type="password" class="form-control-lg form-control rounded-3" required placeholder="Confirm Password" id="spcpassword">&nbsp;
        
        <div class="row">
            <div class="col-12">
            <div class="form-control form-control-lg">
                <input type="checkbox" id="spagree" checked class="form-check-input" required> &nbsp;
                I agree <a href="#">Terms and Conditions</a></div>&nbsp;<hr>
            </div>
        </div>
        <div class="row"> <!--Button Set-->
            <div class="col-6"><button type="submit" class="btn btn-outline-success btn-lg form-control">SignUp</button></div>
            <div class="col-6"><button type="reset" class="btn btn-outline-danger btn-lg form-control">Clear</button></div>
        </div>
        </div>  
    </div>
</form>
<!-- signup end -->
</div>
</div> 
</div>
<script>
    $(document).on("submit","#login",(e)=>{
        e.preventDefault();
        var toServer=new FormData();
        toServer.append('email',$('#email').val());
        toServer.append('password',$('#password').val());
        fetch("<?php echo base_url('login/userLogin')?>",{
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
            if(data.message==="t"){
                window.location.replace("<?php echo base_url('home')?>");
            }else{
                alert ("Invalid username or password"); window.location.reload();
            }
        })
        .catch(() => {
            console.log("Network connection error");
            alert("Reloading");
        });
    })
    $(document).on("submit","#signup",(e)=>{
        e.preventDefault();
        if($("#sppassword").val()==$("#spcpassword").val()){
            var toServer=new FormData();
            toServer.append('fname',$('#spfname').val());
            toServer.append('lname',$('#splname').val());
            toServer.append('email',$('#spemail').val());
            toServer.append('password',$('#sppassword').val());
            fetch("<?php echo base_url('login/userSignup')?>",{
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
            })
            .catch(() => {
                console.log("Network connection error");
                alert("Reloading");
            });
        }else{
            alert("Password should be same !");
        }
        
    })
</script>