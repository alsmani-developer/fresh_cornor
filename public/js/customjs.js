

//           function SpareOrderReporttype(type_num){
//             if (type_num==1){
                
//               $('#ListLabel').html('حالة الطلبيـة');
//              $('#List').empty();
// $('#List').append("<option value='1'>الكـل</option>");
// $('#List').append("<option value='2'>تـم تسليمـها </option>");
// $('#List').append("<option value='3'>تـم الرد عليـها </option>");
// $('#List').append("<option value='3'>في الإنتـظار  </option>");
//         }
        
//        else  if (type_num==2){
              
//           $.ajax({
//               method : 'GET' ,
//               url : '/GetBranches',
//               dataType: "json",
           
//           })
//           .done(function(data){
//               $('#ListLabel').html('الفـرع / الرئاسـة');
//          $('#List').empty();
//             $('#List').append(data.map(function(sObj){
//                   return '<option value="'+sObj.branches_name+'">'+ sObj.branches_name +'</option>'
                
//               }));
//           }) ;  
//       }
  
// }



function GetCustomerOrders(id){

   $.ajax({
        method : 'GET' ,
        url : '/GetCustomerOrders/'+id,
        dataType: "json",
     
    })
    .done(function(data){
   $('#OrdersList').empty();
   $('#OrdersList').append("<option value=''> -- </option>");

      $('#OrdersList').append(data.map(function(sObj){
            return '<option value="'+sObj.id+'">'+ sObj.id +'</option>'
        }));
    }) ;
  
}  


    function GetCustomerOrdersSummary(id){
        $.ajax({
            method : 'GET' ,
            url : '/GetCustomerOrdersSummary/'+id ,
    
        }).done(function(data){
            $('#OrderSummary').empty();

            // console.log(data);
            var x = data.split(',') ;
            var all = x[0] ;
            var WaitingSpareorder = x[1] ;
            var RepliedSpareorder  = x[2] ; 
            var DeleiverdSpareorder  = x[3] ; 
            
           
            var table = "<table  class='table table-bordered' width='100%'>\
            <thead>\
                <tr>\
                    <th>عدد الطلبيـات الكـلي للعميـل</th>\
                    <th>الطلبيـات في الإنتظـار</th>\
                    <th>الطلبيـات المردود عليـها</th>\
                    <th>الطلبيـات المستلـمة</th>\
                </tr>\
            </thead>\
            <tbody>" ;
            table += "<tr>" ;
            table += "<td>"+all+"</td>\
                            <td>"+WaitingSpareorder+"</td>\
                            <td>"+RepliedSpareorder+"</td>\
                            <td>"+DeleiverdSpareorder+"</td>" ;
            table += "</tr>" ;
         table += "</tbody></table>" ;
    
        $("#CustomerOrdersSummary").html(table) ;
    

        }) ;
    }



    function GetCustomerOrderDetails(id){
        $.ajax({
            method : 'GET' ,
            url : '/GetCustomerOrderDetails/'+id ,
    
        }).done(function(data){
            $('#OrderDetails').empty();
            
            $('#OrderId').html(id);

            // console.log(data);
            var x = data.split(',') ;
            var CustomerName = x[0] ;
            var CustomerPhone = x[1] ;
            var LocalityName  = x[2] ; 
            var CarModel  = x[3] ; 
            var CarCompany = x[4] ;
            var vehicle_id = x[5] ;
            var itemsCount  = x[6] ; 
            var production_Date  = x[7] ;
            var date  = x[8] ;
           var OrderId=x[9];
          
            var table = "<table  class='table table-bordered' width='100%'>\
            <thead>\
                <tr>\
                <th>اسـم العميـل</th>\
                <th>رقـم الهـاتـف </th>\
                <th>عنـوان الطلبيه</th>\
                <th>المـوديـل</th>\
                <th>الشـركـة</th>\
                <th>رقـم الهيكـل</th>\
                <th> تـاريـخ الصـنع</th>\
                <th>عدد القطـع</th>\
                <th>تـاريـخ الطلبيـه</th>\
                  <th>تفاصيـل الطلبيـه</th>\
   <th>العـروض علي الطلبيـه</th>\
                </tr>\
            </thead>\
            <tbody>" ;
            table += "<tr>" ;
            table += "<td>"+CustomerName+"</td>\
                            <td>"+CustomerPhone+"</td>\
                            <td>"+LocalityName+"</td>\
                            <td>"+CarModel+"</td>\
                            <td>"+CarCompany+"</td>\
                            <td>"+vehicle_id+"</td>\
                            <td>"+production_Date+"</td>\
                            <td>"+itemsCount+"</td>\
                             <td>"+date+"</td>\
                            <td><a target='_blank' href='/Spareorder/show/"+OrderId+"'>&nbsp;<i class='fa fa-eye fa-2x' aria-hidden='true'></i></a></td>\
                             <td><a target='_blank' href='/Spareorder/MerchantsOffers/"+OrderId+"'>&nbsp;<i class='fa fa-users fa-2x' aria-hidden='true'></i></a></td>";
            table += "</tr>" ;
         table += "</tbody></table>" ;
    
        $("#OrderDetailsTable").html(table) ;
    

        }) ;
    }

    
    // function GetCustomerOrderDetails(id){

    //     $.ajax({
    //         method : 'GET' ,
    //         url : '/GetCustomerOrderDetails/'+id,
    //         dataType: "json",
         
    //     })
    //     .done(function(data){
    //     $('#OrderDetails').empty();
    //       $('#Body').empty();
          
    //       var table = " <tr '>\
    //   <th>اسـم العميـل</th>\
    //   <th>عنـوان الطلبيه</th>\
    //   <th>المـوديـل</th>\
    //   <th>الشـركـة</th>\
    //   <th>رقـم الهيكـل</th>\
    //   <th>  تـاريـخ الصـنع</th>\
    //   <th>عدد القطـع</th>\
    //   <th>تـاريـخ الطلبيـه</th>\    <tr>";
    
    //       $('#Body').html(table);
    
    //       $('#Body').append(data.map(function (sObj) {
    //       console.log (sObj.status);
    //           return "<tr> <td style='border:1px solid #dee2e6; border-bottom-width:0px;'>" + sObj.amount + "</td>\
    //           <td style='border:1px solid #dee2e6; border-bottom-width:0px;' >"+ sObj.scheduled_date + "</td>\
    //           <td style='border:1px solid #dee2e6; border-bottom-width:0px;'>"+ sObj.status + "  </td>\
    //           <td style='border:1px solid #dee2e6; border-bottom-width:0px;'> <a onclick='paySchedule("+ sObj.id + ")'> دفـع </a>  </td>\
    //         </tr>" ;
            
            
            
    //       }));
         
    // }) ;
       
    //}
