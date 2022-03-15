<div class="border border-dark bg-dark text-white">
    <h5>&nbsp;<i class="fas fa-user"></i> &nbsp;  Hello, <?php echo $user?> </h5>
</div>
<div class="container">
    <br>
    <div class="col-4">
        <a href="<?php echo base_url('home/addquestions'); ?>" class="btn btn-success btn-lg form-control">
            <i class="fas fa-plus-circle"></i> &nbsp;Add Questions
        </a>&nbsp;
        <a href="<?php echo base_url('home/myquestions'); ?>" class="btn btn-success btn-lg form-control"><i class="fas fa-search"></i> &nbsp;List My Questions</a>&nbsp;
        <a href="" class="btn btn-danger btn-lg form-control"><i class="fas fa-cogs"></i> &nbsp;My Account</a>&nbsp;
    </div>
</div>