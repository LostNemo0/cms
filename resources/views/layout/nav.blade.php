<style>
  li a:hover{
    background-color: #87b048;
    color: white;
  }
   .nav-item{
    text-align: center;
    color: black;
    padding:1px;
  }
  .nav-link.active{
    background-color: #87b048;
    color: black;
  }
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="elitelogo.png" alt="logo image" width="150" height="40">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-left: 20px;">
      <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link crew" href="/crew">Crew</a>
          </li>
          <li class="nav-item">
            <a class="nav-link docs" href="/document">Documents</a>
          </li>
          <li class="nav-item">
            <a class="nav-link rank" href="/rank">Ranks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link users" href="/user">Users</a>
          </li>
          <li class="nav-item">
            <a style="cursor:pointer;" id="logoutbtn" class="nav-link">Logout</a>
          </li>
        </ul>
    </div>
  </div>
</nav>