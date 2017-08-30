<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title></title>
   {{ Html::style(getRtlCss(mix('css/backend.css'))) }}
</head>
<body>
   <?php $total_amount = 0; ?>
   <img src="{{ asset('header.png') }}" alt="" usemap="#headermap" style="width: 100%;">
   <label style="position: absolute; left: 20px; top: 250px;">{{ $purchase_order->vendor }}<br>{{ $purchase_order->vendor_address }}</label>
   <label style="position: absolute; left: 175px; top: 780px;">{{ $purchase_order->vendor }}</label>
   <label style="position: absolute; left: 580px; top: 246px;">{{ $purchase_order->payment_terms }}</label>
   <label style="position: absolute; left: 640px; top: 290px;">{{ $purchase_order->phone }}</label>
   <label style="position: absolute; left: 765px; top: 290px;">{{ $purchase_order->verbal }}</label>
   <label style="position: absolute; left: 865px; top: 290px;">{{ $purchase_order->quotation }}</label>
   <label style="position: absolute; left: 865px; top: 170px;">{{ $purchase_order->order_date }}</label>
   <label style="position: absolute; left: 600px; top: 325px;">{{ $purchase_order->purchaser }}</label>
   <label style="position: absolute; left: 600px; top: 800px;">{{ $purchase_order->purchaser }}</label>
   <label style="position: absolute; left: 830px; top: 800px;">{{ $purchase_order->manager }}</label>
   <br><br><br>
   <div class="container">
      <table class="table">
         <thead>
            <th>ITEM NO.</th>
            <th>DESCRIPTION</th>
            <th>QTY</th>
            <th>UNIT</th>
            <th>UNIT PRICE</th>
            <th>TOTAL PRICE</th>
         </thead>



         <tbody>
            @foreach($request_projects as $request_project)
            <?php
            $allPrice = $request_project->ordered_quantity * $request_project->material;
            $total_amount += $allPrice;
            ?>
            <tr>
               <td>{{ $request_project->item->id }}</td>
               <td>{{ $request_project->item->item }}</td>
               <td>{{ $request_project->ordered_quantity }}</td>
               <td>{{ $request_project->unit }}</td>
               <td>{{ $request_project->material }}</td>
               <td>
                  {{ number_format($request_project->ordered_quantity * $request_project->material, 2) }}
               </td>
            </tr>
            @endforeach
         </tbody>

         <tfoot>
            <tr>
               <td>TOTAL AMOUNT</td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td>{{ number_format($total_amount, 2) }}</td>
            </tr>
         </tfoot>
      </table>
   </div>
   <br>
   <img src="{{ asset('footer.png') }}"  style="width: 100%;">
</body>
</html>
