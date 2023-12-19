<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>
<table id="customers">
    <tr>
      <td><h3>Liberty School</h3></td>
      <td><h3>Liberty School ERP</h3>
        <p>School Address :Ambo</p>
        <p>Phone:0922966541</p>
        <p>Email:support@libertyschool.com</p>
    </td>
      
    </tr>
    
  </table>
<table id="customers">
  <tr>
    <th width="10%">SNo</th>
    <th width="45%">student Details</th>
    <th width="45%">Student Data</th>
  </tr>
  <tr>
    <td>1</td>
    <td><b>Student Name</b></td>
    <td>{{$details['student']['name']}}</td>
  </tr>
  <tr>
    <td>2</td>
    <td><b>Student IDNo</b></td>
    <td>{{$details['student']['id_no']}}</td>
  </tr>
  <tr>
    <td>3</td>
    <td><b>Student Role</b></td>
    <td>{{$details->roll}}</td>
  </tr>
  <tr>
    <td>4</td>
    <td><b>Father's Name</b></td>
    <td>{{$details['student']['fname']}}</td>
  </tr>
  <tr>
    <td>5</td>
    <td><b>Mother's Name</b></td>
    <td>{{$details['student']['mname']}}</td>
  </tr>
  <tr>
    <td>6</td>
    <td><b>Mobile</b></td>
    <td>{{$details['student']['mobile']}}</td>
  </tr>
  <tr>
    <td>7</td>
    <td><b>Address</b></td>
    <td>{{$details['student']['address']}}</td>
  </tr>
  <tr>
    <td>8</td>
    <td><b>Gender</b></td>
    <td>{{$details['student']['gender']}}</td>
  </tr>
  
  <tr>
    <td>9</td>
    <td><b>Religion</b></td>
    <td>{{$details['student']['religion']}}</td>
  </tr>
  <tr>
    <td>10</td>
    <td><b>Date of Birth</b></td>
    <td>{{$details['student']['dob']}}</td>
  </tr>
  <tr>
    <td>11</td>
    <td><b>Discount</b></td>
    <td>{{$details['discount']['discount']}}%</td>
  </tr>
  <tr>
    <td>12</td>
    <td><b>Year</b></td>
    <td>{{$details['student_year']['name']}}</td>
  </tr>
  <tr>
    <td>13</td>
    <td><b>Class</b></td>
    <td>{{$details['student_class']['name']}}</td>
  </tr>
  <tr>
    <td>14</td>
    <td><b>Group</b></td>
    <td>{{$details['student_group']['name']}}</td>
  </tr>
  <tr>
    <td>15</td>
    <td><b>Shift</b></td>
    <td>{{$details['student_shift']['name']}}</td>
  </tr>
</table>
<br><br>
<i style="font-size:10px; float: right;">Print Date:{{date("d M Y")}} </i>
</body>
</html>


