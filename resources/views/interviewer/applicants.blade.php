<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Intrested Candidates</title>
</head>
<body>



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
            <th>Name</th>
            <th>Email</th>
            <th>Degree</th>
            <th>Resume</th>
            <th>Schedule Interview</th>
          </tr>
    @foreach ($candidates as $candidate)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$candidate->name}}</td>
            <td>{{$candidate->email}}</td>
            <td>{{$candidate->degree}}</td>
            <td>

              <button onclick="window.open('{{ asset("storage/resumes/{$jobid}_{$candidate->id}.pdf") }}', '_blank')">Resume</button>
            </td>
            <td><form action="{{route('interview.store')}}" method="POST">
              @csrf <!-- {{ csrf_field() }} -->
              <label for="schedule">Schedule (date and time):</label>
              <input type="datetime-local" id="schedule" name="schedule" min="{{$currentDateTime}}" required>
              <input type="number" name="candidateID" value="{{ $candidate->id }}" hidden />
              <input type="number" name="interviewerID" value="{{ $interviewerID}}" hidden />
              <input type="number" name="jobID" value="{{ $jobid}}" hidden />
              <input type="submit">
            </form></td>
          </tr>
@endforeach
    </table>
    