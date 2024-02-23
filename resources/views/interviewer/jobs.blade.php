<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Your Jobs</title>
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
            <th>Job ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Salary</th>
            <th>Check Applicants</th>
          </tr>
    @foreach ($jobs as $job)
        <tr>
            <td>{{$job->id}}</td>
            <td>{{$job->name}}</td>
            <td>{{$job->description}}</td>
            <td>{{$job->salary}}</td>
            <td><a href="{{ route('interviewer.applicants', ['jobid' => $job->id]) }}">
              <button>Applicants</button></a>            </td>
          </tr>
@endforeach
    </table>
    