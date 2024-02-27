@include('nav')

<style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    
    tr:nth-child(even) {
      background-color: #dddddd;
    }
    </style>
    <table>
        <tr>
            <th>Position</th>
            <th>Description</th>
            <th>Salary</th>
            <th>Company</th>
            <th>Listed By</th>
            <th>Click to apply</th>
          </tr>
    @foreach ($jobs as $job)
        <tr>
            <td>{{$job->name}}</td>
            <td>{{$job->description}}</td>
            <td>{{$job->salary}}</td>
            <td>{{$job->company}}</td>
            <td>{{$job->position}}</td>
            <td>
                <form action="{{ route('upload.pdf') }}" id="myForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="number" name="job_id" id="job_id" value="{{$job->id}}" hidden>
                    <input type="number" name="candidateId" id="candidateId" value="{{$candidateId}}" hidden>
                    <label for="pdf_file">Attach Resume  </label>
                    <input type="file" name="pdf_file" id="pdf_file" required>
                    
                </form>
                
                <a href="#">
                <button onclick="getData({{ $job->id }},{{$candidateId}})">Apply</button>
              </a>
              </td>


          </tr>
@endforeach
    </table>
    <!-- Blade template -->

<script>
    function getData(parameter,id) {
        // Make an AJAX request to the API endpoint with the parameter
        var fileInput = document.getElementById("pdf_file");
        if (fileInput.files.length === 0) {
            alert('Please select a file.');
            return;
        }
        fetch('{{url('/')}}'+'/candidate/apply/'+id+'/' + parameter)
                    .then(response => {
                if (response.ok) {
                    // Parse JSON response
                    
                    return response.json();
                } else {
                    // Handle error response
                    throw new Error('Network response was not ok.');
                }
            })
            .then(data => {
                var form = document.getElementById("myForm");
                 // Submit the form
                form.submit();
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });
    }
</script>
