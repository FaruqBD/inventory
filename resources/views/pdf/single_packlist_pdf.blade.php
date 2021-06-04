<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  </head>
  <body style="font-size: 10px; margin-top: 50px;">

    <main>
      <div class="clearfix">
        <div >
          <h1 class="text-center">STAR AND DAISY</h1>
          <div class="text-center"><span >{{$pdfData['title']}}</span><span > Date : {{$pdfData['date']}}</span></div>
          <br>
        </div>
      </div>
      <table border="1" cellspacing="0" cellpadding="0" class="col-12">
        <thead>
          <tr>
            <th class="text-center" width="10%">#</th>
            <th class="text-center" width="50%">Product Name</th>
            <th class="text-center" width="20%">Godown No</th>
            <th class="text-center" width="10%">Available Quantity</th>
            <th class="text-center" width="10%">Required Quantity</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">1</td>
            <td >{{$pdfData['product_name']}}</td>
            <td class="text-center">{{$pdfData['godown']}}</td>
            <td class="text-center">{{$pdfData['available_qty']}}</td>
            <td class="text-center">{{$pdfData['required_qty']}} </td>
          </tr>

        </tbody>
        
      </table>
  </body>
  <!-- <script src="{{asset('plugins/jquery/js/jquery-2.1.4.js')}}"></script> -->
  <!-- <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}" ></script> -->
</html>