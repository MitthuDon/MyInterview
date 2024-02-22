<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <style>
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }
    
    li {
      float: left;
    }
    
    li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    
    li a:hover:not(.active) {
      background-color: #111;
    }
    
    .active {
      background-color: #04AA6D;
    }
    </style>
  
    
    <ul>
      <li><a href="{{route('interviewer.index')}}">Home</a></li>
      <li><a href="{{route('interviewer.addjob')}}">Add Job</a></li>
      <li><a href="{{route('interviewer.jobs')}}">Jobs</a></li>
      <li style="float:right"><a href="#" onclick="document.getElementById('logout-form').submit();"> Logout</a></li>
    </ul>
    
        <form id="logout-form" action="{{ route('interviewer.logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
<section class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
        <div class="card border border-light-subtle rounded-3 shadow-sm">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Register</h2>
    
    <!-- form begin -->

            <form action="{{route('interviewer.addjob')}}" method="post">
              @csrf <!-- {{ csrf_field() }} -->
              <div class="row gy-2 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" required>
                    <label for="name" class="form-label">Name</label>
                  </div>
                </div>             

                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="description" id="description" placeholder="description" required>
                    <label for="description" class="form-label">Description</label>
                  </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" name="salary" id="salary" placeholder="salary" required>
                      <label for="salary" class="form-label">Salary in LPA</label>
                    </div>
                  </div>
                <div class="col-12">
                  <div class="d-grid my-3">
                    <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</form>
</body>
</html>