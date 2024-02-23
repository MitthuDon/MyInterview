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
            <th>No.</th>
            <th>Schedule</th>
            <th>JobID</th>
            <th>Canidadate Name</th>
            <th>Canidadate Email</th>
            <th>Status</th>
          </tr>
    @foreach ($interviews as $interview)
        <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>{{$interview->schedule}}</td>
            <td>{{$interview->job_id}}</td>
            <td>{{$interview->name}}</td>
            <td>{{$interview->email}}</td>
            <td>{{$interview->status}}</td>
          </tr>
@endforeach
    </table>