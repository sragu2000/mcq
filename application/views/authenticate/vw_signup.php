<div class="container">
    <br>
   <!-- signup start -->
   <form id="signup" method="post">
   <div class="card border-dark ">
       <!-- card header -->
       <div class="card-header form-control-lg"><strong><center>SignUp</center></strong></div>
       <!-- card body -->
       <div class="card-body">
       <input type="text" class="form-control-lg form-control rounded-3" required placeholder="fullname" id="spfullname"> &nbsp;
       <input type="email" class="form-control-lg form-control rounded-3" required placeholder="Email" id="spemail">&nbsp;
       <input type="password" class="form-control-lg form-control rounded-3" required placeholder="Password" id="sppassword">&nbsp;
       <div class="row">
           <div class="col-12">
           <div class="form-control form-control-lg">
               <input type="checkbox" id="spagree" class="form-check-input" required> &nbsp;
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
<script>
    $(document).on("submit","#signup",(e)=>{
        e.preventDefault();
        var toServer=new FormData();
        toServer.append('fullname',$("#spfullname").val());
        toServer.append('email',$("#spemail").val());
        toServer.append('password',$("#sppassword").val());
        fetch("<?php echo base_url('authenticate/validatesignup'); ?>",{
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
        .catch((e) => {
            console.log(e);
            alert("Reloading");
        });
    })
</script>