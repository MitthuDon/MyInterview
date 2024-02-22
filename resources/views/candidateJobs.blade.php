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
            <td><a href="#">
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
                // Handle the data received from the server
                console.log(data);

                // Check if reload flag is set to true
                if (data.reload) {
                    // Reload the page
                    window.location.reload();
                }
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });
    }
</script>
