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
            <th>Update</th>
          </tr>
    @foreach ($interviews as $interview)
        <tr>

            <td>{{ $loop->index+1 }}</td>
            <td>{{$interview->schedule}}
              <button class="btn" onclick="clickBtn(this)">Re:Schedule</button>
                          <form action="{{route('interview.reschedule')}}" method="POST" class="hidden"
            id="form">
              @csrf
              <input type="number" id= "candidateID" name='candidateID' value="{{$interview->candidate_id}}" hidden>
              <input type="number" id= "interviewID" name='interviewID' value="{{$interview->id}}" hidden>
              <input type="datetime-local" id="schedule" name="schedule" min="{{ now()->format('Y-m-d\TH:i') }}" required>
              <button  type="submit">Submit</button>

            </form>
            </td>
            <td>{{$interview->job_id}}</td>
            <td>{{$interview->name}}</td>
            <td>{{$interview->email}}</td>
            <td>{{$interview->status}}</td>
            <td> <a href="{{route('interview.updateview', ['id' => $interview->id])}}"><button>Status Update</button></a></td>
          </tr>
@endforeach
    </table>
    <style>
      .hidden{
        display: none;
      }
    </style>
    <script>
 function clickBtn(button){
        var form = button.nextElementSibling;
        button.classList.add('hidden');
        form.classList.remove('hidden');
    }
    </script>
  </body>
  </html>