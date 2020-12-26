

function GetCompanyCarsModels(Compay_ID){
  
   $.ajax({
        method : 'GET' ,
        url : '/GetCompanyCarsModels/'+Compay_ID,
        dataType: "json",
     
    })
    .done(function(data){
         console.log(data);
   $('#Models').empty();
   $('#Models').append("<option value=''> -- </option>");

      $('#Models').append(data.map(function(sObj){
            return '<option value="'+sObj.name+'">'+ sObj.name +'</option>'
        }));
    }) ;

}


function GetStateLocalites(state_ID){
  
    $.ajax({
         method : 'GET' ,
         url : '/GetStateLocalites/'+state_ID,
         dataType: "json",
      
     })
     .done(function(data){
          console.log(data);
    $('#Localites').empty();
    $('#Localites').append("<option value=''> -- </option>");
 
       $('#Localites').append(data.map(function(sObj){
             return '<option value="'+sObj.name+'">'+ sObj.name +'</option>'
         }));
     }) ;
 
 }



