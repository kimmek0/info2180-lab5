onload= function(){
    var btn=document.getElementById('lookup');
    var btn2=document.getElementById('lookup2')
    var request=new XMLHttpRequest();
    var result=document.getElementById('result');
    var country=document.getElementById('country');
    btn.addEventListener('click',function(event){
        event.preventDefault();
        var url="world.php?country="+country.value;
        request.onreadystatechange=hrequest;
        request.open('GET',url,true);
        request.send(); 
    })
    btn2.addEventListener('click',function(event){
        event.preventDefault();
        var url="world.php?country="+country.value+"&context=cities";
        request.onreadystatechange=hrequest;
        request.open('GET',url,true);
        request.send(); 
    });

    function hrequest(){
        if(request.readyState===XMLHttpRequest.DONE){
            if (request.status===200){
                var response=request.responseText;
                result.innerHTML=response;
            }else{
                result.innerHTML="Error. There was a problem with the request";
            }
        }
    }
} 