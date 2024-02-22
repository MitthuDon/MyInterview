@include('interviewer/nav')
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
            <th>Job ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Salary</th>
          </tr>
    @foreach ($jobs as $job)
        <tr>
            <td>{{$job->id}}</td>
            <td>{{$job->name}}</td>
            <td>{{$job->description}}</td>
            <td>{{$job->salary}}</td>
          </tr>
@endforeach
    </table>
    