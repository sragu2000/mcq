<nav class="navbar navbar-expand-lg navbar-light bg-light border border-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo base_url("home") ?>"><i class="fas fa-home"></i>&nbsp;Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
          <a class="nav-link active" href="<?php echo base_url('home'); ?>"><i class="fas fa-toolbox"></i>&nbsp;Dashboard</a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="#"><i class="far fa-clipboard"></i>&nbsp;Exam</a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="#"><i class="far fa-id-badge"></i>&nbsp;Score</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Question
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?php echo base_url('question/addquestion'); ?>">Add Question</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('question/myquestions'); ?>">My Questions</a></li>
          </ul>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li> -->
      </ul>
      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button> &nbsp;&nbsp;
      </form> -->
      <form class="d-flex">
        <a class="btn btn-outline-danger" href="<?php echo base_url('home/logout');?>"><i class="fas fa-power-off"></i> &nbsp;Logout</a>
      </form>
    </div>
  </div>
</nav>
<div class="bg-dark text-light">&nbsp;&nbsp;<strong>
  <?php echo ucwords("Welcome, ". $user);?>
</strong></div>