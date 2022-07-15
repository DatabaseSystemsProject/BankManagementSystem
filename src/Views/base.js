class Header extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light" >
    <a class="navbar-brand mb-0 h1" onclick="gotoDashboard()">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <!--<li class="nav-item active">
          <a class="nav-link" href="#">Dashboard<span class="sr-only"></span></a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" id=id3 style="float: right;" onclick="document.getElementById('id01').style.display='block'" href="#">Log out</a>
        </li>
        <!-- <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> -->
        
      </ul> 




    <div id="id01" class="logout">
        <div class=" p-4 logout_msg animate">
            <div class="top">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>
            <h1 style="color: tomato;">Log Out</h1>
            <p><?php echo "name"; ?>Are you sure you want to log out?</p>
            <!-- <p>Are you sure you want to Log out?</p> -->
            <!-- <input type="button" class="yes" name="logout"  value="Yes"> -->
            <form method="post">
                <button id="log" type="submit" class="yes" name="logout">Yes</button>
                <button id="log" type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">No</button>
            </form>


        </div>
    </div>
   
    </div>
    

  </nav>
          `
  }
}



function display_notification() {
  var x = document.getElementById("notification-list");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
class Footer extends HTMLElement {
  connectedCallback() {
    this.innerHTML =
      `
          <!-- Footer -->
  <footer class="page-footer font-small blue pt-4">
  
    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">
  
      <!-- Grid row -->
      <div class="row">
  
        <!-- Grid column -->
        <div class="col-md-6 mt-md-0 mt-3">
  
          <!-- Content -->
          <h5 class="text-uppercase">Footer Content</h5>
          <p>Here you can use rows and columns to organize your footer content.</p>
  
        </div>
        <!-- Grid column -->
  
        <hr class="clearfix w-100 d-md-none pb-3">
  
        <!-- Grid column -->
        <div class="col-md-3 mb-md-0 mb-3">
  
          <!-- Links -->
          <h5 class="text-uppercase">Links</h5>
  
          <ul class="list-unstyled">
            <li>
              <a href="#!">Link 1</a>
            </li>
            <li>
              <a href="#!">Link 2</a>
            </li>
            <li>
              <a href="#!">Link 3</a>
            </li>
            <li>
              <a href="#!">Link 4</a>
            </li>
          </ul>
  
        </div>
        <!-- Grid column -->
  
        <!-- Grid column -->
        <div class="col-md-3 mb-md-0 mb-3">
  
          <!-- Links -->
          <h5 class="text-uppercase">Links</h5>
  
          <ul class="list-unstyled">
            <li>
              <a href="#!">Link 1</a>
            </li>
            <li>
              <a href="#!">Link 2</a>
            </li>
            <li>
              <a href="#!">Link 3</a>
            </li>
            <li>
              <a href="#!">Link 4</a>
            </li>
          </ul>
  
        </div>
        <!-- Grid column -->
  
      </div>
      <!-- Grid row -->
  
    </div>
    <!-- Footer Links -->
  
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2022 Copyright:
      <a href=""> copyright</a>
    </div>
    <!-- Copyright -->
  
  </footer>
  <!-- Footer -->
  
        `

  }
}


customElements.define('main-footer', Footer);
customElements.define('main-header', Header);  